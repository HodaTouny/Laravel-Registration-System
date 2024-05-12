<?php

namespace Tests\Unit;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Users; // Assuming User is the correct model name

class PassHashTest extends TestCase
{
    use RefreshDatabase;

    #[Test] public function password_is_hashed_before_saving_to_database()
    {
        $user = new Users([
            'name' => 'John Doe',
            'user_name' => 'johndoe123',
            'email' => 'john@example.com',
            'address' => '123 Main St',
            'phone_number' => '+20100000000',
            'Birth' => '1990-01-01',
            'password' => 'Password@1',
            'password_confirmation' => 'Password@1',
            'image' => UploadedFile::fake()->image('profile.jpg')
        ]);

        $user->password = Hash::make($user->password);
        $user->save();

        $this->assertNotEquals('Password@1', $user->password);
        $this->assertTrue(Hash::check('Password@1', $user->password));
    }

}
