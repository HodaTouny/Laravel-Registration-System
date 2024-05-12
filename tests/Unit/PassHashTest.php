<?php

namespace Tests\Unit;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Users;

class PassHashTest extends TestCase
{
    use RefreshDatabase; // Automatically reset the database after each test to ensure clean state (empty)

    // Define a test method with the #[Test] attribute indicating it's a test case
    #[Test] public function password_is_hashed_before_saving_to_database()
    {
        // Create a new user instance with sample data
        $user = new Users([
            'name' => 'Farah momo',
            'user_name' => 'farahmomo123',
            'email' => 'farah@example.com',
            'address' => '123 old cairo',
            'phone_number' => '+20100000000',
            'Birth' => '1990-01-01', //
            'password' => 'Password@1',
            'password_confirmation' => 'Password@1',
            'image' => UploadedFile::fake()->image('profile.jpg')
        ]);

        // Hash the password using Laravel's Hash facade before saving to database
        $user->password = Hash::make($user->password);
        $user->save(); // Save the user to the database

        // Assert that the plaintext password is not the same as the hashed password stored in the database
        $this->assertNotEquals('Password@1', $user->password);

        // Verify that the plaintext password correctly matches the hashed password when checked
        $this->assertTrue(Hash::check('Password@1', $user->password));
    }

}
