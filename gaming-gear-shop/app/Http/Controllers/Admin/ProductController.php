<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category; 
use App\Models\Brand;    
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Str;         
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log; 

class ProductController extends Controller
{
    private $uploadPath = 'preview/image/product'; 

    /**
     * Hiển thị danh sách sản phẩm.
     */
    public function index(): View
    {
       
        $products = Product::with(['category', 'brand'])->latest('id')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Hiển thị form tạo sản phẩm mới.
     */
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    /**
     * Lưu sản phẩm mới vào database.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $imageDbPath = null;
        $galleryDbPaths = null;
        

        if ($request->hasFile('image')) {
            try {
                $imageFile = $request->file('image');
                $imageName = Str::uuid() . '.' . $imageFile->getClientOriginalExtension();
                $destinationPath = public_path($this->uploadPath);

                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true, true);
                }
                $imageFile->move($destinationPath, $imageName);
                $imageDbPath = $this->uploadPath . '/' . $imageName;
            } catch (\Exception $e) {
                Log::error('Error uploading product image: ' . $e->getMessage());
            }
        }
        $validatedData['image'] = $imageDbPath;

        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            $destinationPath = public_path($this->uploadPath . '/gallery');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            foreach ($request->file('gallery') as $galleryFile) {
                try {
                    $galleryName = Str::uuid() . '.' . $galleryFile->getClientOriginalExtension();
                    $galleryFile->move($destinationPath, $galleryName);
                    $galleryPaths[] = $this->uploadPath . '/gallery/' . $galleryName; 
                } catch (\Exception $e) {
                    Log::error('Error uploading gallery image: ' . $e->getMessage());
                }
            }
            $validatedData['gallery'] = isset($galleryPaths) ? json_encode($galleryPaths) : null;
        }
        $validatedData['image'] = $imageDbPath;
        $validatedData['is_new'] = $request->boolean('is_new');
        $validatedData['is_featured'] = $request->boolean('is_featured');
        $validatedData['status'] = $request->boolean('status', true); 

        Product::create($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    /**
     * Hiển thị form chỉnh sửa sản phẩm.
     */
    public function edit(Product $product): View
    {
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Cập nhật sản phẩm trong database.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $validatedData = $request->validated();
        $imageDbPath = $product->image; 
        $galleryDbPaths = $product->gallery; 
        if ($request->hasFile('image')) {
            try {
                if ($product->image && File::exists(public_path($product->image))) {
                    File::delete(public_path($product->image));
                }
                $imageFile = $request->file('image');
                $imageName = Str::uuid() . '.' . $imageFile->getClientOriginalExtension();
                $destinationPath = public_path($this->uploadPath);
                if (!File::exists($destinationPath)) { File::makeDirectory($destinationPath, 0755, true, true); }
                $imageFile->move($destinationPath, $imageName);
                $imageDbPath = $this->uploadPath . '/' . $imageName;
            } catch (\Exception $e) {
                 Log::error('Error updating product image: ' . $e->getMessage());
                 $imageDbPath = $product->image; 
            }
        }
        $validatedData['image'] = $imageDbPath;

        if ($request->hasFile('gallery')) {
            $oldGallery = json_decode($product->gallery ?? '[]', true);
            if (is_array($oldGallery)) {
                foreach ($oldGallery as $oldImage) {
                    if (File::exists(public_path($oldImage))) {
                        File::delete(public_path($oldImage));
                    }
                }
            }
            $galleryPaths = [];
            $destinationPath = public_path($this->uploadPath . '/gallery');
            if (!File::exists($destinationPath)) { File::makeDirectory($destinationPath, 0755, true, true); }

            foreach ($request->file('gallery') as $galleryFile) {
                 try {
                    $galleryName = Str::uuid() . '.' . $galleryFile->getClientOriginalExtension();
                    $galleryFile->move($destinationPath, $galleryName);
                    $galleryPaths[] = $this->uploadPath . '/gallery/' . $galleryName;
                 } catch (\Exception $e) {
                     Log::error('Error uploading gallery image on update: ' . $e->getMessage());
                 }
            }
            $galleryDbPaths = json_encode($galleryPaths); 
        }
        $validatedData['gallery'] = $galleryDbPaths;


        $validatedData['is_new'] = $request->boolean('is_new');
        $validatedData['is_featured'] = $request->boolean('is_featured');
        $validatedData['status'] = $request->boolean('status'); 

        $product->update($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    /**
     * Xóa sản phẩm.
     */
    public function destroy(Product $product): RedirectResponse
    {
        if ($product->image && File::exists(public_path($product->image))) {
            File::delete(public_path($product->image));
        }

        $gallery = json_decode($product->gallery ?? '[]', true);
        if (is_array($gallery)) {
             foreach ($gallery as $image) {
                 if (File::exists(public_path($image))) {
                     File::delete(public_path($image));
                 }
             }
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công!');
    }
}