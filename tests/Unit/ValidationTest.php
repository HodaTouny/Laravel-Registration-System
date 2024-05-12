<?php

namespace Tests\Unit;


use App\Http\Requests\Validations;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{

    #[Test] public function test_registration_validation_rules()
    {
        // Instantiate the Validations request class, which contains the validation rules.
        $request = new Validations();

        // Retrieve the rules defined in the Validations class.
        $rules = $request->rules();

        // Define the expected rules that we assume should be present in the Validations class.
        $expectedRules = [
            'name' => 'required|string|min:3|regex:/^[a-zA-Z]+(\s[a-zA-Z]+)+$/u',
            'user_name' => 'required|string|unique:users,user_name',
            'email' => 'required|email:users,email',
            'phone_number' => 'required|regex:/^\+?[0-9]{11}$/',
            'password' => 'required|string|min:8|regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\W_])[a-zA-Z0-9!@#$%^&*]{8,}$/|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'Birth' => 'required|date|before_or_equal:today',
        ];

        // Assert that the actual rules match the expected rules.
        // This ensures that any changes in the rules are deliberate and that the rules enforce the correct constraints.
        $this->assertEquals($expectedRules, $rules, "The validation rules should match the expected rules.");
    }
}
