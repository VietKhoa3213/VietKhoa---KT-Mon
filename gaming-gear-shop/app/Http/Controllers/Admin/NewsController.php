<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News; 
use App\Models\User; 
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    private $uploadPath = 'preview/image/news';


    public function index(): View
    {
        $news = News::with('author')->latest('id')->paginate(15);
        return view('admin.news.index', compact('news'));
    }

    public function create(): View
    {

        return view('admin.news.create');
    }

  
    public function store(StoreNewsRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $imageDbPath = null;

        if ($request->hasFile('image')) {
            try {
                $imageFile = $request->file('image');
                $imageName = Str::uuid() . '.' . $imageFile->getClientOriginalExtension();
                $destinationPath = public_path($this->uploadPath);
                if (!File::exists($destinationPath)) { File::makeDirectory($destinationPath, 0755, true, true); }
                $imageFile->move($destinationPath, $imageName);
                $imageDbPath = $this->uploadPath . '/' . $imageName;
            } catch (\Exception $e) {
                Log::error('Error uploading news image: ' . $e->getMessage());
            }
        }
        $validatedData['image'] = $imageDbPath;

        $validatedData['author_id'] = Auth::id();

        $validatedData['status'] = $request->boolean('status');

        News::create($validatedData);

        return redirect()->route('admin.news.index')->with('success', 'Thêm tin tức thành công!');
    }


    public function edit(News $news): View 
    {
        return view('admin.news.edit', compact('news'));
    }

   
    public function update(UpdateNewsRequest $request, News $news): RedirectResponse
    {
        $validatedData = $request->validated();
        $imageDbPath = $news->image; 

        if ($request->hasFile('image')) {
            try {
                if ($news->image && File::exists(public_path($news->image))) {
                    File::delete(public_path($news->image));
                }
                $imageFile = $request->file('image');
                $imageName = Str::uuid() . '.' . $imageFile->getClientOriginalExtension();
                $destinationPath = public_path($this->uploadPath);
                if (!File::exists($destinationPath)) { File::makeDirectory($destinationPath, 0755, true, true); }
                $imageFile->move($destinationPath, $imageName);
                $imageDbPath = $this->uploadPath . '/' . $imageName;
            } catch (\Exception $e) {
                 Log::error('Error updating news image: ' . $e->getMessage());
                 $imageDbPath = $news->image; 
            }
        }
        $validatedData['image'] = $imageDbPath;

        $validatedData['status'] = $request->boolean('status');


        $news->update($validatedData);

        return redirect()->route('admin.news.index')->with('success', 'Cập nhật tin tức thành công!');
    }

   
    public function destroy(News $news): RedirectResponse
    {
        try {
            if ($news->image && File::exists(public_path($news->image))) {
                File::delete(public_path($news->image));
            }
            $news->delete();
            return redirect()->route('admin.news.index')->with('success', 'Xóa tin tức thành công!');
        } catch (\Exception $e) {
            Log::error("Error deleting news ID {$news->id}: " . $e->getMessage());
            return redirect()->route('admin.news.index')->with('error', 'Đã xảy ra lỗi khi xóa tin tức.');
        }
    }
}
