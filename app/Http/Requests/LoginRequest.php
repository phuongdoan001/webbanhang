<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'taikhoan' => 'required|email',
            'matkhau' => 'required|min:6|max:16',
            
        ];
    }
    public function messages(){
        return [
            'taikhoan.required' => 'Tài khoản không được để trống',
            'taikhoan.email'    => 'Tài khoản phải là email',
            'matkhau.required'  => 'Mật khẩu không được để trống',
            'matkhau.min'       => 'Mật khẩu không được nhỏ hơn 6 ký tự và lớn hơn 16 ký tự',
            'matkhau.max'       => 'Mật khẩu không được nhỏ hơn 6 ký tự và lớn hơn 16 ký tự',
            
        ];
    }
}
