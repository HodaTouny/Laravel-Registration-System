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
            'address' => 'required',
            'password' => 'required|string|min:8|regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\W_])[a-zA-Z0-9!@#$%^&*]{8,}$/|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'Birth' => 'required|date|before_or_equal:today',
            'image' => 'required',
        ];
    }

    public function messages()
    {
        $language = app()->getLocale();

        if ($language === 'ar') {
            return [
                'name.required' => '.حقل الاسم مطلوب',
                'name.string' => '.يجب أن يكون الاسم نصًا',
                'name.min' => '.يجب أن يتكون الاسم من  :min أحرف على الأقل',
                'name.regex' => '.تنسيق الاسم غير صحيح',
                'user_name.required' => '.حقل اسم المستخدم مطلوب',
                'user_name.string' => '.يجب أن يكون اسم المستخدم نصًا',
                'user_name.unique' => '.اسم المستخدم تم اخذه بالفعل',
                'email.required' => '.حقل البريد الالكتروني مطلوب',
                'email.email' => '.يجب أن يكون البريد الالكتروني صالح',
                'phone_number.required' => '.حقل رقم الهاتف مطلوب',
                'phone_number.regex' => '.تنسيق رقم الهاتف غير صحيح',
                'address.required' => '.حقل العنوان مطلوب',
                'password.required' => '.حقل كلمة المرور مطلوب',
                'password.string' => '.يجب أن تكون كلمة المرور نصًا',
                'password.min' => '.يجب أن تكون كلمة المرور على الأقل :min أحرف',
                'password.regex' => '.تنسيق كلمة المرور غير صالح',
                'password.confirmed' => '.تأكيد كلمة المرور غير مطابق',
                'password_confirmation.required' => '.حقل تأكيد كلمة المرور مطلوب',
                'password_confirmation.string' => '.يجب أن يكون تأكيد كلمة المرور نصًا',
                'password_confirmation.min' => '.يجب أن تكون تأكيد كلمة المرور على الأقل :min أحرف',
                'Birth.required' => '.حقل تاريخ الميلاد مطلوب',
                'Birth.date' => '.يجب أن يكون تاريخ الميلاد تاريخًا صالحًا',
                'Birth.before_or_equal' => '.يجب أن يكون تاريخ الميلاد قبل أو يساوي اليوم',
                'image.required' => '.حقل الصورة مطلوب'
            ];
        } else {
            return [
                'name.required' => 'The name field is required.',
                'name.string' => 'The name must be a string.',
                'name.min' => 'The name must be at least :min characters.',
                'name.regex' => 'The name format is invalid.',
                'user_name.required' => 'The username field is required.',
                'user_name.string' => 'The username must be a string.',
                'user_name.unique' => 'The username has already been taken.',
                'email.required' => 'The email field is required.',
                'email.email' => 'The email must be a valid email address.',
                'phone_number.required' => 'The phone number field is required.',
                'phone_number.regex' => 'The phone number format is invalid.',
                'address.required' => 'The address field is required.',
                'password.required' => 'The password field is required.',
                'password.string' => 'The password must be a string.',
                'password.min' => 'The password must be at least :min characters.',
                'password.regex' => 'The password format is invalid.',
                'password.confirmed' => 'The password confirmation does not match.',
                'password_confirmation.required' => 'The password confirmation field is required.',
                'password_confirmation.string' => 'The password confirmation must be a string.',
                'password_confirmation.min' => 'The password confirmation must be at least :min characters.',
                'Birth.required' => 'The birth date field is required.',
                'Birth.date' => 'The birth date must be a valid date.',
                'Birth.before_or_equal' => 'The birth date must be before or equal to today.',
                'image.required' => 'The image field is required.',
            ];
        }
    }


}
