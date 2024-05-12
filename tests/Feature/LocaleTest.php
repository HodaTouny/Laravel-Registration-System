<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Models\User;

class LocaleTest extends TestCase
{

    #[Test] public function it_does_not_change_locale_for_unsupported_languages()
    {
        session(['locale' => 'en']);
        $response = $this->get('/locale/es'); // 'es' is not supported
        $response->assertRedirect();
        $this->assertEquals('en', session('locale'));
    }

    #[Test] public function it_changes_the_locale_and_redirects()
    {
        $response = $this->get('/locale/ar');
        $response->assertRedirect();
        $this->assertEquals('ar', session('locale'));
    }




}
