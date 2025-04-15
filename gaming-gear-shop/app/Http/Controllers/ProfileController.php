<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\UpdateUserProfileRequest; 
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Models\User; 


class ProfileController extends Controller
{
    private $avatarUploadPath = 'preview/image/user'; 
    private $defaultAvatarName = 'avatar_default.jpg';     

  
    public function show(Request $request): View
    {
        $user = $request->user(); 

        return view('profile.show', compact('user'));
    }

  
    public function update(UpdateUserProfileRequest $request): RedirectResponse 
    {
        $user = $request->user(); 
        $updateData = $request->validated(); 

        if ($request->hasFile('avatar')) {
            try {
                $oldAvatar = $user->avatar; 
                $absoluteOldPath = null;

                if ($oldAvatar) {
                    if (Str::startsWith($oldAvatar, $this->avatarUploadPath . '/')) {
                        $absoluteOldPath = public_path($oldAvatar); 
                    } else {
                        $absoluteOldPath = public_path($this->avatarUploadPath . '/' . $oldAvatar); 
                    }
                }

                $defaultAvatarFullPath = $this->avatarUploadPath . '/' . $this->defaultAvatarName;
                if ($absoluteOldPath && $oldAvatar !== $this->defaultAvatarName && $oldAvatar !== $defaultAvatarFullPath && File::exists($absoluteOldPath)) {
                    File::delete($absoluteOldPath);
                    Log::info("User Profile Update: Deleted old avatar {$oldAvatar} for User {$user->id}");
                }

                $imageFile = $request->file('avatar');
                $imageName = Str::uuid() . '.' . $imageFile->getClientOriginalExtension();
                $destinationPath = public_path($this->avatarUploadPath);
                if (!File::exists($destinationPath)) { File::makeDirectory($destinationPath, 0755, true, true); }
                $imageFile->move($destinationPath, $imageName);

                $updateData['avatar'] = $imageName;
                Log::info("User Profile Update: Uploaded new avatar {$imageName} for User {$user->id}");

            } catch (\Exception $e) {
                 Log::error("User Profile Update: Error uploading avatar for User {$user->id}: " . $e->getMessage());
                 unset($updateData['avatar']);
            }
        } else {
             unset($updateData['avatar']);
        }

        if ($request->filled('current_password') && $request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                 return redirect()->back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác.'])->withInput();
             }
             $updateData['password'] = Hash::make($updateData['password']);
             Log::info("User Profile Update: Password updated for User {$user->id}.");
        } else {
            unset($updateData['password']);
             unset($updateData['current_password']); 
             unset($updateData['password_confirmation']);
        }

         unset($updateData['current_password']);
         unset($updateData['password_confirmation']);
         unset($updateData['email']);


        try {
             $user->update($updateData); 
             Log::info("User Profile Update: Profile updated successfully for User {$user->id}.");
             return redirect()->route('profile.show')->with('success', 'Cập nhật thông tin thành công!');
        } catch (\Exception $e) {
             Log::error("User Profile Update: Error updating profile for User {$user->id}: " . $e->getMessage());
             return redirect()->back()->withInput()->with('error', 'Đã xảy ra lỗi khi cập nhật thông tin.');
        }
    }

    public function orders(): View 
    {
        $user = Auth::user();

        $orders = $user->orders() 
                       ->withCount('orderDetails') 
                       ->latest('created_at')      
                       ->paginate(10);            

        return view('profile.orders', compact('orders'));
    }

}