<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $this->get('/register/researcher')->assertOk();
        $this->get('/register/participant')->assertOk();
    }

    public function test_registration_screen_is_not_available_for_unknown_account_types(): void
    {
        $this->get('/register/admin')->assertNotFound();
    }

    public function test_new_users_can_register_as_researcher(): void
    {
        $this->seed(RoleSeeder::class);

        $response = $this->post('/register/researcher', [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'researcher',
        ]);

        $user = User::where('email', 'test@example.com')->firstOrFail();

        $this->assertAuthenticatedAs($user);
        $this->assertTrue($user->hasRole('researcher'));
        $this->assertFalse($user->hasRole('participant'));
        $response->assertRedirect('/dashboard');
    }

    public function test_new_users_can_register_as_participant(): void
    {
        $this->seed(RoleSeeder::class);

        $response = $this->post('/register/participant', [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'participant@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'participant',
        ]);

        $user = User::where('email', 'participant@example.com')->firstOrFail();

        $this->assertAuthenticatedAs($user);
        $this->assertTrue($user->hasRole('participant'));
        $this->assertFalse($user->hasRole('researcher'));
        $response->assertRedirect('/dashboard');
    }

    public function test_the_route_decides_the_role_even_without_a_posted_role(): void
    {
        $this->seed(RoleSeeder::class);

        $this->post('/register/participant', [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'route-decides@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])->assertRedirect('/dashboard');

        $user = User::where('email', 'route-decides@example.com')->firstOrFail();

        $this->assertTrue($user->hasRole('participant'));
        $this->assertFalse($user->hasRole('researcher'));
    }

    public function test_a_mismatched_role_is_rejected(): void
    {
        $this->seed(RoleSeeder::class);

        $response = $this->from('/register/researcher')->post('/register/researcher', [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'mismatch@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'participant',
        ]);

        $this->assertGuest();
        $this->assertDatabaseMissing('users', ['email' => 'mismatch@example.com']);
        $response->assertRedirect('/register/researcher');
        $response->assertSessionHasErrors('role');
    }
}
