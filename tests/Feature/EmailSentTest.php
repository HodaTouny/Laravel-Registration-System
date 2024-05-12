<?php

namespace Tests\Feature;

use App\Mail\UserRegistered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class EmailSentTest extends TestCase
{
    use RefreshDatabase;  // Ensures that each test has a fresh database state

    #[Test] public function email_is_sent_on_successful_registration()
    {
        Mail::fake();  // Intercepts and fakes all mail sending operations to prevent actual emails during tests

        // Form data simulating what a user would submit during registration
        $formData = [
            'name' => 'John Doe',
            'user_name' => 'johndoe',
            'email' => 'john@example.com',
            'address' => '123 Main St',
            'phone_number' => '+20100000000',
            'Birth' => '1990-01-01',
            'password' => 'Password@1',
            'password_confirmation' => 'Password@1',
            'image' => UploadedFile::fake()->image('profile_email_test.jpg')  // Simulates file upload
        ];

        // Sending a POST request to the registration route and capturing the response
        $response = $this->json('POST', '/register_user', $formData);

        // for debugging purposes to print out the response when the test does not pass
         if ($response->status() !== 200) {
             dd($response->json());  // Dump and Die the response data to troubleshoot
         }

        // Assert that the HTTP response status is 200 (OK)
        $response->assertStatus(200);

        // Check that an email of the type UserRegistered has been sent
        Mail::assertSent(UserRegistered::class);
    }
}
