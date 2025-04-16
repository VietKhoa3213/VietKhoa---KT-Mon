<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide; 
use App\Http\Requests\StoreSlideRequest;
use App\Http\Requests\UpdateSlideRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;


class SlideController extends Controller
{
    private $uploadPath = 'preview/image/slides'; 

  


    public function index(): View
    {
        $slides = Slide::orderBy('sort_order', 'asc')->latest('id')->paginate(10);
        return view('admin.slides.index', compact('slides'));
    }

 
    public function create(): View
    {
        return view('admin.slides.create');
    }

   
    public function store(StoreSlideRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $imageDbPath = null;

        if ($request->hasFile('image')) {
            Log::info('Store Slide: Has image file.'); 
            try {
                $imageFile = $request->file('image');
                if (!$imageFile->isValid()) { 
                   Log::error('Store Slide: Invalid image file uploaded. Error code: ' . $imageFile->getError());
                   return redirect()->back()->withInput()->with('error', 'File ảnh tải lên không hợp lệ.');
                }
    
                $imageName = Str::uuid() . '.' . $imageFile->getClientOriginalExtension();
                $destinationPath = public_path($this->uploadPath);
                 Log::info('Store Slide: Destination path: ' . $destinationPath);
    
                if (!File::exists($destinationPath)) {
                     Log::info('Store Slide: Directory does not exist, creating: ' . $destinationPath);
                    File::makeDirectory($destinationPath, 0755, true, true);
                } else {
                     Log::info('Store Slide: Directory already exists: ' . $destinationPath); 
                }
    
                 Log::info('Store Slide: Moving file to: ' . $destinationPath . '/' . $imageName);
                $imageFile->move($destinationPath, $imageName);
                 Log::info('Store Slide: File moved successfully.'); 
    
                $imageDbPath = $this->uploadPath . '/' . $imageName;
            } catch (\Exception $e) {
                Log::error('Store Slide: Error uploading slide image: ' . $e->getMessage()); 
                return redirect()->back()->withInput()->with('error', 'Lỗi tải lên hình ảnh: ' . $e->getMessage()); 
            }
        } else {
             Log::warning('Store Slide: No image file found in request.');
             return redirect()->back()->withInput()->with('error', 'Vui lòng chọn hình ảnh cho slide.');
        }

        $validatedData['image'] = $imageDbPath;
        $validatedData['sort_order'] = $request->input('sort_order', 0); 
        $validatedData['status'] = $request->boolean('status'); 

        Slide::create($validatedData);

        return redirect()->route('admin.slides.index')->with('success', 'Thêm slide thành công!');
    }


  
    public function edit(Slide $slide): View 
    {
        return view('admin.slides.edit', compact('slide'));
    }

    public function update(UpdateSlideRequest $request, Slide $slide): RedirectResponse
    {
        $validatedData = $request->validated();
        $imageDbPath = $slide->image;

        if ($request->hasFile('image')) {
            try {
                if ($slide->image && File::exists(public_path($slide->image))) {
                    File::delete(public_path($slide->image));
                }
                $imageFile = $request->file('image');
                $imageName = Str::uuid() . '.' . $imageFile->getClientOriginalExtension();
                $destinationPath = public_path($this->uploadPath);
                if (!File::exists($destinationPath)) { File::makeDirectory($destinationPath, 0755, true, true); }
                $imageFile->move($destinationPath, $imageName);
                $imageDbPath = $this->uploadPath . '/' . $imageName;
            } catch (\Exception $e) {
                 Log::error('Error updating slide image: ' . $e->getMessage());
                 $imageDbPath = $slide->image; 
            }
        }
        $validatedData['image'] = $imageDbPath;

        $validatedData['sort_order'] = $request->input('sort_order', $slide->sort_order); 
        $validatedData['status'] = $request->boolean('status');

        $slide->update($validatedData);

        return redirect()->route('admin.slides.index')->with('success', 'Cập nhật slide thành công!');
    }

  
    public function destroy(Slide $slide): RedirectResponse
    {
         try {
            if ($slide->image && File::exists(public_path($slide->image))) {
                File::delete(public_path($slide->image));
            }
            $slide->delete();
            return redirect()->route('admin.slides.index')->with('success', 'Xóa slide thành công!');
        } catch (\Exception $e) {
            Log::error("Error deleting slide ID {$slide->id}: " . $e->getMessage());
            return redirect()->route('admin.slides.index')->with('error', 'Đã xảy ra lỗi khi xóa slide.');
        }
    }
}
