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
    use RefreshDatabase;

    #[Test] public function email_is_sent_on_successful_registration()
    {
        Mail::fake();
        $formData = [
            'name' => 'John Doe',
            'user_name' => 'johndoe',
            'email' => 'john@example.com',
            'address' => '123 Main St',
            'phone_number' => '+20100000000',
            'Birth' => '1990-01-01',
            'password' => 'Password@1',
            'password_confirmation' => 'Password@1',
            'image' => UploadedFile::fake()->image('profile_email_test.jpg')
        ];

        $response = $this->json('POST', '/register_user', $formData);

//        // Debugging line in case of unexpected status
//        if ($response->status() !== 200) {
//            dd($response->json());
//        }

        $response->assertStatus(200);
        Mail::assertSent(UserRegistered::class);
    }



}
