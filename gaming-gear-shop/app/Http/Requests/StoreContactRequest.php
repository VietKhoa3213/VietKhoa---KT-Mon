<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest {
    public function authorize(): bool { return true;  }
    public function rules(): array {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|max:2000',
        ];
    }
    public function messages(): array { 
        return [
            'name.required' => 'Vui lòng nhập họ tên.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'message.required' => 'Vui lòng nhập nội dung tin nhắn.',
            '*.max' => 'Thông tin nhập vượt quá độ dài cho phép.',
        ];
    }
}