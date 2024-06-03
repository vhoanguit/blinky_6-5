<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    public function rules()
    {
        return [
            'customer_email' => 'required|email|unique:tbl_customers,customer_email',
            'customer_pass' => 'required|min:6',
            'customer_name' => 'required|min:6',
            'customer_phone' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'customer_email.required' => 'Trường địa chỉ email là bắt buộc.',
            'customer_email.email' => 'Trường địa chỉ email phải là một địa chỉ email hợp lệ.',
            'customer_email.unique' => 'Địa chỉ email đã tồn tại.',
            'customer_pass.required' => 'Trường mật khẩu là bắt buộc.',
            'customer_pass.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'customer_name.required' => 'Trường tên là bắt buộc.',
            'customer_name.min' => 'Tên phải có ít nhất :min ký tự.',
            'customer_phone.required' => 'Trường số điện thoại là bắt buộc.',
        ];
    }
}
