<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRouteLoginDisplaysViewAuthLogin()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    public function testLoginDisplaysValidationErrors()
    {
        $response = $this->post(route('login'), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    }

    public function testLoginRedirectToHome()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    public function testRegisterAndRedirectToHome()
    {
        $response = $this->post(route('register'), [
            'name' => 'User Test',
            'email' => 'usertest@gmail.com',
            'password' => 'password',
            'job' => 'Estudiante universitario',
            'birthday' => \Carbon\Carbon::create(1996, 05, 12, 0,0,0),
            'password_confirmation' => 'password'
        ]);

        //$response->assertStatus(200);

        $response->assertRedirect('/home');
    }

    public function testTableUserHasData()
    {
        $this->assertDatabaseHas('users', [
            'name' => 'User Test',
            'email' => 'usertest@gmail.com'
        ]);
    }

    public function testUserActingAsAuthenticate()
    {
        $user = factory(User::class)->create();
        $user->roles()->sync(['3']);

        $response = $this->actingAs($user)->get(route('home'));

        $response->assertStatus(200);
    }
}
