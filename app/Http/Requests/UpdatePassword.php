<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePassword extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
    public function messages()
    {
        return [
          'password.required' => 'Vui lòng nhập đủ mật khẩu',
          'password.string'  => 'Mật khẩu phải là dạng chuỗi',
            'password.min' => 'Mật khẩu tối thiểu :min ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không đúng'
        ];
    }
}
