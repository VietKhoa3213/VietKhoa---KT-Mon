<?php

namespace App\Http\Requests;

use Doctrine\Inflector\Rules\English\Rules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'], 
            'password' => ['required', 'string', 'min:6', 'confirmed'], 
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'address' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'string', Rule::in(['Nam', 'Nữ', 'Khác'])], 
            'level' => ['required', 'integer', Rule::in([1, 2, 3])], 
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:1024'], 
        ];
    }

    public function messages(): array
    {
         return [
             'name.required' => 'Họ tên là bắt buộc.',
             'email.required'=>'Vui lòng nhập email',
             'email.email'=>'Email không đúng định dạng',
             'email.unique'=>'Email này đã được đăng ký',
             'password.required'=>'Vui lòng nhập mật khẩu',
             'password.min'=>'Mật khẩu phải có ít nhất 6 ký tự',
             'password.confirmed'=>'Mật khẩu xác nhận không khớp',
             'phone.regex' => 'Số điện thoại không hợp lệ.',
             'gender.in' => 'Giới tính không hợp lệ.',
             'level.required' => 'Vui lòng chọn quyền cho người dùng.',
             'level.in' => 'Quyền người dùng không hợp lệ.',
             'avatar.image' => 'Tệp tải lên phải là hình ảnh.',
            'avatar.mimes' => 'Ảnh đại diện phải có định dạng: jpeg, png, jpg, gif, svg, webp.',
            'avatar.max' => 'Ảnh đại diện tối đa là 1MB.',
         ];
    }
}
