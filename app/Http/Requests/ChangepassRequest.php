<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangepassRequest extends FormRequest
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
            'OldPass' => ['required', function ($attribute, $value, $fail) {
                $customer_id = session('customer_id');
                $customer = DB::table('tbl_customers')->where('customer_id', $customer_id)->first();
                if (!$customer || !Hash::check($value, $customer->customer_password)) {
                    $fail('Mật khẩu cũ không đúng');
                }
            }],
            'NewPass' => 'required|string|min:6',
            'ConfirmPass' => 'required|same:NewPass',
        ];
    }
    public function messages()
    {
        return [
            'NewPass.required' => 'Bạn phải nhập mật khẩu cũ.',
            'NewPass.min' => 'Mật khẩu mới phải chứa ít nhất 6 kí tự.',
            'ConfirmPass.required' => 'Bạn phải nhập mật khẩu mới.',
            'ConfirmPass.same' => 'Mật khẩu xác nhận phải khớp với mật khẩu mới.',
        ];
    }
}
