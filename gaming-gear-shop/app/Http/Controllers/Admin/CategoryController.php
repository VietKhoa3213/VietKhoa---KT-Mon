<?php

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller; 
use App\Models\Category; 
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Storage; 
use Illuminate\View\View; 
use Illuminate\Http\RedirectResponse; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
  
    public function index(): View
    {
        $categories = Category::latest()->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    
    public function create(): View
    {
        return view('admin.categories.create');
    }

    
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $imageDbPath = null; 

    
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');

            $imageName = Str::uuid() . '.' . $imageFile->getClientOriginalExtension();

            $relativeUploadPath = 'preview/image/category'; 
            $destinationPath = public_path($relativeUploadPath); 
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $imageFile->move($destinationPath, $imageName);

            $imageDbPath = $relativeUploadPath . '/' . $imageName;
        }

        $validatedData['image'] = $imageDbPath; 

        Category::create($validatedData);

        return redirect()->route('admin.categories.index')->with('success', 'Thêm loại sản phẩm thành công!');
    }

   
    public function show(Category $category): View 
    {
         return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category): View 
    {
        return view('admin.categories.edit', compact('category'));
    }

   
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $validatedData = $request->validated();
        $imageDbPath = $category->image; 

        if ($request->hasFile('image')) {
            if ($category->image) {
                $oldImagePathAbsolute = public_path($category->image); 
                if (File::exists($oldImagePathAbsolute)) {
                    File::delete($oldImagePathAbsolute); 
                }
            }

            $imageFile = $request->file('image');
            $imageName = Str::uuid() . '.' . $imageFile->getClientOriginalExtension();
            $relativeUploadPath = 'preview/image/category';
            $destinationPath = public_path($relativeUploadPath);

            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $imageFile->move($destinationPath, $imageName);
            $imageDbPath = $relativeUploadPath . '/' . $imageName; 
        }

        $validatedData['image'] = $imageDbPath;

        $category->update($validatedData);

        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật loại sản phẩm thành công!');
    }

    
    public function destroy(Category $category): RedirectResponse
    {
        if ($category->image) {
            $imagePathAbsolute = public_path($category->image);
            if (File::exists($imagePathAbsolute)) {
                File::delete($imagePathAbsolute);
            }
        }
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Xóa loại sản phẩm thành công!');
    }
}
