<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand; 
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Str;         
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
    private $uploadPath = 'preview/image/brand';

    /**
     * Hiển thị danh sách thương hiệu.
     */
    public function index(): View
    {
        $brands = Brand::latest('id')->paginate(10);
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Hiển thị form tạo thương hiệu mới.
     */
    public function create(): View
    {
        return view('admin.brands.create');
    }

    /**
     * Lưu thương hiệu mới.
     */
    public function store(StoreBrandRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $logoDbPath = null;

        if ($request->hasFile('logo')) {
            try {
                $imageFile = $request->file('logo');
                $imageName = Str::uuid() . '.' . $imageFile->getClientOriginalExtension();
                $destinationPath = public_path($this->uploadPath); 

                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true, true);
                }
                $imageFile->move($destinationPath, $imageName);
                $logoDbPath = $this->uploadPath . '/' . $imageName;
            } catch (\Exception $e) {
                Log::error('Error uploading brand logo: ' . $e->getMessage());
            }
        }
        $validatedData['logo'] = $logoDbPath;

        Brand::create($validatedData);

        return redirect()->route('admin.brands.index')->with('success', 'Thêm thương hiệu thành công!');
    }

    /**
     * Hiển thị form chỉnh sửa thương hiệu.
     */
    public function edit(Brand $brand): View
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Cập nhật thương hiệu.
     */
    public function update(UpdateBrandRequest $request, Brand $brand): RedirectResponse
    {
        $validatedData = $request->validated();
        $logoDbPath = $brand->logo; 

        if ($request->hasFile('logo')) {
            try {
                if ($brand->logo && File::exists(public_path($brand->logo))) {
                    File::delete(public_path($brand->logo));
                }
                $imageFile = $request->file('logo');
                $imageName = Str::uuid() . '.' . $imageFile->getClientOriginalExtension();
                $destinationPath = public_path($this->uploadPath);
                if (!File::exists($destinationPath)) { File::makeDirectory($destinationPath, 0755, true, true); }
                $imageFile->move($destinationPath, $imageName);
                $logoDbPath = $this->uploadPath . '/' . $imageName;
            } catch (\Exception $e) {
                 Log::error('Error updating brand logo: ' . $e->getMessage());
                 $logoDbPath = $brand->logo; 
            }
        }
        $validatedData['logo'] = $logoDbPath;

        $brand->update($validatedData);

        return redirect()->route('admin.brands.index')->with('success', 'Cập nhật thương hiệu thành công!');
    }

    /**
     * Xóa thương hiệu.
     */
    public function destroy(Brand $brand): RedirectResponse
    {
        try {
            if ($brand->logo && File::exists(public_path($brand->logo))) {
                File::delete(public_path($brand->logo));
            }
            $brand->delete();
            return redirect()->route('admin.brands.index')->with('success', 'Xóa thương hiệu thành công!');
        } catch (\Illuminate\Database\QueryException $e) {
             Log::error("Error deleting brand ID {$brand->id}: " . $e->getMessage());
             return redirect()->route('admin.brands.index')->with('error', 'Không thể xóa thương hiệu này vì có sản phẩm đang sử dụng.');
        } catch (\Exception $e) {
            Log::error("Error deleting brand ID {$brand->id}: " . $e->getMessage());
            return redirect()->route('admin.brands.index')->with('error', 'Đã xảy ra lỗi khi xóa thương hiệu.');
        }
    }
}