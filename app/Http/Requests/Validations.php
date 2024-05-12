<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Validations extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|regex:/^[a-zA-Z]+(\s[a-zA-Z]+)+$/u',
            'user_name' => 'required|string|unique:users,user_name',
            'email' => 'required|email:users,email',
            'phone_number' => 'required|regex:/^\+?[0-9]{11}$/',
            'password' => 'required|string|min:8|regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\W_])[a-zA-Z0-9!@#$%^&*]{8,}$/|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'Birth' => 'required|date|before_or_equal:today',
        ];
    }

    public function messages()
    {
        return [
            'user_name.unique' => 'The username has already been taken.',
        ];
    }
}
