<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $this->get('/login/researcher')->assertOk();
        $this->get('/login/participant')->assertOk();
    }

    public function test_login_screen_is_not_available_for_unknown_account_types(): void
    {
        $this->get('/login/admin')->assertNotFound();
        $this->post('/login/admin', [])->assertNotFound();
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login/researcher', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/dashboard');
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login/researcher', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_researcher_can_authenticate_through_the_researcher_login(): void
    {
        $this->seed(RoleSeeder::class);

        $user = User::factory()->create();
        $user->assignRole('researcher');

        $response = $this->post('/login/researcher', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect('/dashboard');
    }

    public function test_participant_can_authenticate_through_the_participant_login(): void
    {
        $this->seed(RoleSeeder::class);

        $user = User::factory()->create();
        $user->assignRole('participant');

        $response = $this->post('/login/participant', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect('/dashboard');
    }

    public function test_participant_can_not_authenticate_through_the_researcher_login(): void
    {
        $this->seed(RoleSeeder::class);

        $user = User::factory()->create();
        $user->assignRole('participant');

        $response = $this->from('/login/researcher')->post('/login/researcher', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertGuest();
        $response->assertRedirect('/login/researcher');
        $response->assertSessionHasErrors('email');
    }

    public function test_researcher_can_not_authenticate_through_the_participant_login(): void
    {
        $this->seed(RoleSeeder::class);

        $user = User::factory()->create();
        $user->assignRole('researcher');

        $response = $this->from('/login/participant')->post('/login/participant', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertGuest();
        $response->assertRedirect('/login/participant');
        $response->assertSessionHasErrors('email');
    }
}
