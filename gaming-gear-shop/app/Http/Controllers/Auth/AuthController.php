<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password; 
use Illuminate\Auth\Events\PasswordReset; 

class AuthController extends Controller
{
  
    public function create(): View
    {
        return view('auth.register'); 
    }


    public function store(Request $request): RedirectResponse
    {
        
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class, 
            'password' => 'required|string|min:6|max:20|confirmed', 
            'phone' => 'nullable|string|max:20|regex:/^([0-9\s\-\+\(\)]*)$/',
            'address' => 'nullable|string|max:255',
            'gender' => 'required|string|in:Nam,Nữ,Khác'
        ], [
            'fullname.required'=>'Vui lòng nhập họ tên',
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Email không đúng định dạng',
            'email.unique'=>'Email này đã được đăng ký',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu phải có ít nhất 6 ký tự',
            'password.max'=>'Mật khẩu không được quá 20 ký tự',
            'password.confirmed'=>'Mật khẩu xác nhận không khớp', 
            'gender.required' => 'Vui lòng chọn giới tính.',
            'gender.in' => 'Giới tính không hợp lệ.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
        ]);
        $defaultAvatar = 'avatar_default.jpg'; 


        $user = User::create([
            'name' => $validatedData['fullname'], 
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'phone' => $request->phone,
            'address' => $request->address, 
            'gender' => $request->gender,
            'level' => 3,
            'avatar' => $defaultAvatar,
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Đăng ký thành công!');
      
    }


    public function login(): View
    {
         return view('auth.login'); 
    }
   
    public function authenticate(Request $request): RedirectResponse 
    {
        
         $credentials = $request->validate([
            'email'=>'required|email',
            'password'=>'required|string' 
        ], [
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Không đúng định dạng email',
            'password.required'=>'Vui lòng nhập mật khẩu',
            
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
             return redirect('/')->with(['flag'=>'alert','message'=>'Đăng nhập thành công']); 
        } else {
             return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập không thành công'])->onlyInput('email'); 
      
        }
    }

   
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function showLinkRequestForm(): View 
    {
        return view('auth.forgot-password');
    }
    public function sendResetLinkEmail(Request $request): RedirectResponse
{
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink($request->only('email'));

    if ($status == Password::RESET_LINK_SENT) {
        return back()->with('status', 'Link đặt lại mật khẩu đã được gửi! Vui lòng kiểm tra email (cả Spam).');
    }
    return back()->withErrors(['email' => __($status)])->withInput();
}

public function showResetForm(Request $request, string $token): View 
{

    return view('auth.reset-password', [
        'token' => $token,
        'email' => $request->query('email') 
    ]);
}

public function storeNewPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
             return redirect()->route('login') 
                            ->with('status', 'Đặt lại mật khẩu thành công! Bạn có thể đăng nhập ngay.');
        }

        return back()->withErrors(['email' => [__($status)]])->withInput();
    }
}
