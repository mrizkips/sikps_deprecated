<?php

namespace Tests\Feature;

use Tests\TestCase;

class LandingPageTest extends TestCase
{
    /**
     * Test menampilkan landing page.
     *
     * @return void
     */
    public function testMenampilkanLandingPage()
    {
        $response = $this->get(route('landingpage'));
        $response->assertSuccessful();
    }
}
