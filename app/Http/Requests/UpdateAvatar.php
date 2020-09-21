<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAvatar extends FormRequest
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
            'avatar' => ['mimes:jpeg,png,jpg']

        ];
    }
    public function messages()
    {
        return [
            'avatar.required' => 'Chưa chọn file upload',
            'avatar.mimes' => 'Avatar phải thuộc định dạng: :mimes'
        ];
    }
}
