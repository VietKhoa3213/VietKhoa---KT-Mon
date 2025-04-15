<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password; 

class UpdateUserProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $userId = $this->user()->id; 

        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'address' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'string', Rule::in(['Nam', 'Nữ', 'Khác'])],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:1024'], 

            'current_password' => ['nullable', 'required_with:password', 'string'],
            'password' => ['nullable', 'required_with:current_password', 'string', 'min:6', 'confirmed'],
        ];
    }

     public function messages(): array
     {
          return [
             'name.required' => 'Họ tên không được để trống.',
             'phone.regex' => 'Số điện thoại không hợp lệ.',
             'gender.in' => 'Giới tính không hợp lệ.',
             'avatar.image' => 'Tệp tải lên phải là hình ảnh.',
             'avatar.mimes' => 'Ảnh đại diện phải có định dạng: :mimes.',
             'avatar.max' => 'Ảnh đại diện tối đa là 1MB.',
             'current_password.required_with' => 'Bạn phải nhập mật khẩu hiện tại để đổi mật khẩu mới.',
             'password.required_with' => 'Bạn phải nhập mật khẩu mới nếu đã nhập mật khẩu hiện tại.',
             'password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
             'password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
         ];
     }
}