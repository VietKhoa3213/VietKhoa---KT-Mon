<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        $productId = $this->route('product')->id; 

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('products', 'name')->ignore($productId)],
            'category_id' => 'required|integer|exists:categories,id',
            'brand_id' => 'required|integer|exists:brands,id',
            'description' => 'nullable|string',
            'specifications' => 'nullable|json',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'stock_quantity' => 'required|integer|min:0',
            'unit' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'gallery' => 'nullable|array', 
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'is_new' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|boolean',
        ];
    }

     public function messages(): array
     {
          return [
             'name.required' => 'Tên sản phẩm là bắt buộc.',
             'name.unique' => 'Tên sản phẩm này đã tồn tại.',
             'category_id.required' => 'Vui lòng chọn loại sản phẩm.',
             'category_id.exists' => 'Loại sản phẩm không hợp lệ.',
             'brand_id.required' => 'Vui lòng chọn thương hiệu.',
             'brand_id.exists' => 'Thương hiệu không hợp lệ.',
             'price.required' => 'Giá sản phẩm là bắt buộc.',
             'price.numeric' => 'Giá sản phẩm phải là số.',
             'price.min' => 'Giá sản phẩm không được âm.',
             'discount_price.numeric' => 'Giá khuyến mãi phải là số.',
             'discount_price.min' => 'Giá khuyến mãi không được âm.',
             'discount_price.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc.',
             'stock_quantity.required' => 'Số lượng tồn kho là bắt buộc.',
             'stock_quantity.integer' => 'Số lượng tồn kho phải là số nguyên.',
             'stock_quantity.min' => 'Số lượng tồn kho không được âm.',
             'image.image' => 'Ảnh đại diện phải là hình ảnh.',
             'image.mimes' => 'Ảnh đại diện phải có định dạng: jpeg, png, jpg, gif, svg, webp.',
             'image.max' => 'Ảnh đại diện tối đa là 2MB.',
             'gallery.*.image' => 'Tệp trong thư viện ảnh phải là hình ảnh.',
             'gallery.*.mimes' => 'Ảnh trong thư viện phải có định dạng: jpeg, png, jpg, gif, svg, webp.',
             'gallery.*.max' => 'Mỗi ảnh trong thư viện tối đa là 2MB.',
             'is_new.boolean' => 'Trường "Sản phẩm mới" không hợp lệ.',
             'is_featured.boolean' => 'Trường "Sản phẩm nổi bật" không hợp lệ.',
             'status.boolean' => 'Trường "Trạng thái" không hợp lệ.',
             'specifications.json' => 'Thông số kỹ thuật phải là định dạng JSON hợp lệ.'
          ];
     }
}