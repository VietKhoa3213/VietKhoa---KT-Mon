<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Dùng Model User chuẩn
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import Hash
use Illuminate\Support\Facades\Auth; // Import Auth để kiểm tra user hiện tại
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; 
 

class UserController extends Controller
{

    private $avatarUploadPath = 'preview/image/user'; 
    private $defaultAvatarName = 'avatar_default.jpg';

    public function index(): View
    {
        $users = User::latest('id')->paginate(15); 
        return view('admin.users.index', compact('users'));
    }


    public function create(): View
    {

        return view('admin.users.create');
    }

    /**
     * Lưu user mới.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $validatedData['password'] = Hash::make($validatedData['password']);

        $validatedData['avatar'] = $this->defaultAvatarName;

        User::create($validatedData);

        return redirect()->route('admin.users.index')->with('success', 'Thêm người dùng thành công!');
    }
  
    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Cập nhật user.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {

        $validatedData = $request->validated();
        $updateData = $request->validated();

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($updateData['password']); 
        }

        if ($request->hasFile('avatar')) {
            try {
                $oldAvatarValue = $user->avatar; 
                $absoluteOldPath = null;

                if ($oldAvatarValue) {
                    if (Str::startsWith($oldAvatarValue, $this->avatarUploadPath . '/')) {
                        $absoluteOldPath = public_path($oldAvatarValue);
                    } else {
                        $absoluteOldPath = public_path($this->avatarUploadPath . '/' . $oldAvatarValue);
                    }
                }

                if ($absoluteOldPath && $oldAvatarValue !== $this->defaultAvatarName && File::exists($absoluteOldPath)) {
                    File::delete($absoluteOldPath);
                }

                $imageFile = $request->file('avatar');
                $imageName = Str::uuid() . '.' . $imageFile->getClientOriginalExtension();
                $destinationPath = public_path($this->avatarUploadPath); 
                if (!File::exists($destinationPath)) { File::makeDirectory($destinationPath, 0755, true, true); }
                $imageFile->move($destinationPath, $imageName);

                $updateData['avatar'] = $imageName; 

            } catch (\Exception $e) {
                Log::error('Error updating user avatar: ' . $e->getMessage());
                unset($updateData['avatar']); 
            }
        } else {
            unset($updateData['avatar']);
        }

        $user->update($updateData);

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật người dùng thành công!');
    }

    /**
     * Xóa user.
     */
    public function destroy(User $user): RedirectResponse
{
    if ($user->id === Auth::id()) {
         return redirect()->route('admin.users.index')->with('error', 'Bạn không thể xóa chính mình!');
    }

    try {
        $avatarValue = $user->avatar; 
        $absolutePath = null;

         if ($avatarValue) {
             if (Str::startsWith($avatarValue, $this->avatarUploadPath . '/')) {
                 $absolutePath = public_path($avatarValue); 
             } else {
                 $absolutePath = public_path($this->avatarUploadPath . '/' . $avatarValue); 
             }
         }

        if ($absolutePath && $avatarValue !== $this->defaultAvatarName && File::exists($absolutePath)) {
             File::delete($absolutePath);
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Xóa người dùng thành công!');
    } catch (\Exception $e) {
        Log::error("Error deleting user ID {$user->id}: " . $e->getMessage());
        return redirect()->route('admin.users.index')->with('error', 'Đã xảy ra lỗi khi xóa người dùng.');
    }
}
}