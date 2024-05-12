<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Models\User;

class UserRegistrationTest extends TestCase
{
    use  WithFaker;

    /** @test */
    public function user_can_register_successfully()
    {
        $formData = [
            'name' => $this->faker->name,
            'user_name' => $this->faker->userName,
            'email' => $this->faker->safeEmail,
            'address' => $this->faker->address,
            'phone_number' => '+201' . $this->faker->randomNumber(8, true),
            'Birth' => $this->faker->date('Y-m-d'),
            'password' => 'Password@1', // Example password meeting your specified criteria
            'password_confirmation' => 'Password@1',
            'image' => UploadedFile::fake()->image('profile.jpg')

        ];

        $response = $this->json('POST', '/register_user', $formData);

//         Check for validation errors if the response status is 422
        if ($response->status() != 200) {
            dd($response->json());  // Dump the response and die, to see what errors are returned
        }

        $response->assertStatus(200);

        $response->assertJson([
            'success' => true,
            'message' => 'User registered successfully.'
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $formData['email']
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $formData['email'],
            'image' => 'profile.jpg'  // Adjust based on how images are named and stored
        ]);


        $imagePath = public_path('images\\' . $formData['image']->getClientOriginalName());
        $this->assertFileExists($imagePath);

    }

}
