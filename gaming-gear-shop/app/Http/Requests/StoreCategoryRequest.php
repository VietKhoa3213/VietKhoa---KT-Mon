<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true; 
    }

    /**
     * Lấy các quy tắc validation áp dụng cho request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100|unique:categories,name',

            'description' => 'nullable|string',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Tên loại sản phẩm là bắt buộc.',
            'name.unique' => 'Tên loại sản phẩm này đã tồn tại, vui lòng chọn tên khác.',
            'name.max' => 'Tên loại sản phẩm không được dài hơn 100 ký tự.',
            'description.string' => 'Mô tả phải là văn bản.',
            'image.image' => 'Tệp tải lên phải là hình ảnh.',
            'image.mimes' => 'Chỉ chấp nhận hình ảnh định dạng: jpeg, png, jpg, gif, svg, webp.',
            'image.max' => 'Kích thước ảnh tối đa là 2MB.',
        ];
    }
}