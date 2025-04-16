<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Validation\Rule;     

class PlaceOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
     
        $rules = [
            'payment_method' => ['required', 'string', Rule::in(['COD', 'BankTransfer'])],
            'note' => ['nullable', 'string', 'max:1000'],
        ];

        if (Auth::guest()) {
            $rules['customer_name'] = ['required', 'string', 'max:255'];
            $rules['customer_email'] = ['required', 'string', 'email', 'max:255'];
            $rules['customer_phone'] = ['required', 'string', 'max:20', 'regex:/^([0-9\s\-\+\(\)]*)$/'];
            $rules['customer_address'] = ['required', 'string', 'max:500'];
        } else {
             $rules['customer_name'] = ['required', 'string', 'max:255']; 
             $rules['customer_email'] = ['required', 'string', 'email', 'max:255']; 
             $rules['customer_phone'] = ['required', 'string', 'max:20', 'regex:/^([0-9\s\-\+\(\)]*)$/']; 
             $rules['customer_address'] = ['required', 'string', 'max:500']; 
        }

        return $rules;
    }

     public function messages(): array
     {
         return [
             'customer_name.required' => 'Vui lòng nhập tên người nhận.',
             'customer_email.required' => 'Vui lòng nhập email.',
             'customer_email.email' => 'Email không đúng định dạng.',
             'customer_phone.required' => 'Vui lòng nhập số điện thoại.',
             'customer_phone.regex' => 'Số điện thoại không hợp lệ.',
             'customer_address.required' => 'Vui lòng nhập địa chỉ giao hàng.',
             'payment_method.required' => 'Vui lòng chọn phương thức thanh toán.',
             'payment_method.in' => 'Phương thức thanh toán không hợp lệ.',
         ];
     }
}
