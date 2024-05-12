<?php

namespace Tests\Unit;

use App\Http\Requests\Validations;
use App\Models\Users;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ValidationTest extends TestCase
{

    public function test_registration_validation_rules()
    {

        $request = new Validations();

        $rules = $request->rules();

        $expectedRules = [
            'name' => 'required|string|min:3|regex:/^[a-zA-Z]+(\s[a-zA-Z]+)+$/u',
            'user_name' => 'required|string|unique:users,user_name',
            'email' => 'required|email:users,email',
            'phone_number' => 'required|regex:/^\+?[0-9]{11}$/',
            'password' => 'required|string|min:8|regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\W_])[a-zA-Z0-9!@#$%^&*]{8,}$/|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'Birth' => 'required|date|before_or_equal:today',
        ];

        $this->assertEquals($expectedRules, $rules, "The validation rules should match the expected rules.");
    }



}
