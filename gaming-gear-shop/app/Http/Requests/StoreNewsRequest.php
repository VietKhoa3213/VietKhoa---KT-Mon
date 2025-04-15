<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:news,title',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', 
            'status' => 'required|boolean', 
        ];
    }

     public function messages(): array
     {
         return [
             'title.required' => 'Tiêu đề bài viết là bắt buộc.',
             'title.unique' => 'Tiêu đề này đã tồn tại.',
             'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
             'content.required' => 'Nội dung bài viết là bắt buộc.',
             'image.image' => 'Tệp tải lên phải là hình ảnh.',
             'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, svg, webp.',
             'image.max' => 'Kích thước hình ảnh tối đa là 2MB.',
             'status.required' => 'Vui lòng chọn trạng thái.',
             'status.boolean' => 'Trạng thái không hợp lệ.',
         ];
     }
}