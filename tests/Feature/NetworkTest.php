<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class NetworkTest extends TestCase
{
    /**
     * Network test for welcome page.
     *
     * @return void
     */
    public function testWelcome()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
    * Network test for Home page.
    *
    * @return void
    */
    public function testHome()
    {
        $response = $this->get('/home');

        $response->assertStatus(302);
    }

    /**
    * Network test for Home page.
    *
    * @return void
    */
    public function testHomeLoggedIn()
    {
        $user = User::find(1);
        Auth::login($user);
        $response = $this->get('/home');
        $response->assertStatus(200);
    }
}
