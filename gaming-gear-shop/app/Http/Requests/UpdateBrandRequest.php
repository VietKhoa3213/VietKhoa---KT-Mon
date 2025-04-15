<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Middleware đã check
    }

    public function rules(): array
    {
        $brandId = $this->route('brand')->id; // Lấy ID brand đang sửa

        return [
            'name' => ['required', 'string', 'max:100', Rule::unique('brands', 'name')->ignore($brandId)],
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024', // Logo không bắt buộc khi update
        ];
    }

     public function messages(): array
    {
         // Tương tự StoreBrandRequest
         return [
             'name.required' => 'Tên thương hiệu là bắt buộc.',
             'name.unique' => 'Tên thương hiệu này đã tồn tại.',
             'name.max' => 'Tên thương hiệu không được dài hơn 100 ký tự.',
             'logo.image' => 'Logo phải là hình ảnh.',
             'logo.mimes' => 'Logo phải có định dạng: jpeg, png, jpg, gif, svg, webp.',
             'logo.max' => 'Kích thước logo tối đa là 1MB.',
         ];
    }
}