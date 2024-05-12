<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;


class UserRegistrationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    // Test method to check successful user registration
    #[Test] public function user_can_register_successfully()
    {
        // Generating fake form data for user registration
        $formData = [
            'name' => $this->faker->firstName . ' ' . $this->faker->lastName,
            'user_name' => $this->faker->userName,
            'email' => $this->faker->safeEmail,
            'address' => $this->faker->address,
            'phone_number' => '+201' . $this->faker->randomNumber(8, true),
            'Birth' => $this->faker->date('Y-m-d'),
            'password' => 'Password@123',
            'password_confirmation' => 'Password@123',
            'image' => UploadedFile::fake()->image('profile.jpg')
        ];

        // Send a POST request to the registration endpoint with the form data
        $response = $this->json('POST', '/register_user', $formData);

        // Debugging helper: uncomment to output response details if registration fails
        if ($response->status() != 200) {
            dd($response->json());  // This will dump the response and stop the test
        }

        // Asserts that the HTTP response status code should be 200 (OK)
        $response->assertStatus(200);

        // Asserts the JSON structure and content of the response
        $response->assertJson([
            'success' => true,
            'message' => 'User registered successfully.'
        ]);

        // Database assertions to check that the user data is stored correctly
        $this->assertDatabaseHas('users', [
            'user_name' => $formData['user_name'] // Checks if the username (primary Key) exists in the database
        ]);


        $this->assertDatabaseHas('users', [
            'email' => $formData['email'],
            'image' => 'profile.jpg' // Checks if the correct image file name is stored
        ]);

        // Filesystem assertion to ensure the image file exists in the designated path
        $imagePath = public_path('images\\' . $formData['image']->getClientOriginalName());
        $this->assertFileExists($imagePath);
    }

    // Test method to check registration failure on invalid data input
    #[Test] public function user_registration_fails_with_invalid_data()
    {
        // Creating form data with invalid email and missing fields
        //play with it
        $formData = [
            'email' => 'not-an-email', // Invalid email format
            'Password' => 'Password@123',


            // Fields like 'name', 'password' are intentionally do not exist to trigger validation errors
        ];

        // Send a POST request to the registration endpoint with the invalid data
        $response = $this->json('POST', '/register_user', $formData);

        // Asserts that the response status code should be 422 (Unprocessable Entity)
        $response->assertStatus(422);

        // Asserts that the response has validation errors for specified fields
        $response->assertJsonValidationErrors(['email', 'name', 'password']);
    }
}
