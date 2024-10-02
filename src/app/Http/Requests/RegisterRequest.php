<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前は必須です！',
            'email.required' => 'メールアドレスは必須です！',
            'email.email' => 'メールアドレスの形式が無効です！',
            'email.unique' => 'このメールアドレスはすでに登録されています！',
            'password.required' => 'パスワードは必須です！',
            'password.min' => 'パスワードは8文字以上である必要があります！',
        ];
    }
}
