<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSlideRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|string|max:255', 
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', 
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'required|boolean',
        ];
    }

     public function messages(): array
     {
         return [
             'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
             'link.max' => 'Đường dẫn không được vượt quá 255 ký tự.',
             'image.required' => 'Vui lòng chọn hình ảnh cho slide.',
             'image.image' => 'Tệp tải lên phải là hình ảnh.',
             'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, svg, webp.',
             'image.max' => 'Kích thước hình ảnh tối đa là 2MB.',
             'sort_order.integer' => 'Thứ tự hiển thị phải là số nguyên.',
             'sort_order.min' => 'Thứ tự hiển thị không được âm.',
             'status.required' => 'Vui lòng chọn trạng thái.',
             'status.boolean' => 'Trạng thái không hợp lệ.',
         ];
     }
}