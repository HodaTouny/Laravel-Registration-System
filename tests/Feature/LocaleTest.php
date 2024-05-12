<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;  // Attribute to mark methods as test cases
use Tests\TestCase;

class LocaleTest extends TestCase
{
    // Test to ensure that the application changes the locale when a supported language code is provided
    #[Test] public function it_changes_the_locale_and_redirects()
    {
        // Send a GET request to the route that changes the locale, this time to Arabic ('ar'), which is supported
        $response = $this->get('/locale/ar');

        // Assert that the response should be a redirect (this is typical behavior when changing locale settings)
        $response->assertRedirect();

        // Assert that the session locale has been updated to Arabic ('ar')
        $this->assertEquals('ar', session('locale'));
    }


    // Test to ensure that the application does not change the locale to unsupported languages
    #[Test] public function it_does_not_change_locale_for_unsupported_languages()
    {

        // Send a GET request to the route that changes the locale, trying to set it to Spanish ('es'), which is unsupported
        $response = $this->get('/locale/es');

        // Assert that the response should be a redirect (commonly back to where the user came from)
        $response->assertRedirect();

        // Assert that the session locale has not changed and remains as English ('en')
        $this->assertEquals('en', session('locale'));
    }
}
