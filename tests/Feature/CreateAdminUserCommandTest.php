<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateAdminUserCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_create_user_command_creates_super_admin(): void
    {
        $this->seed(RolePermissionSeeder::class);

        $this->artisan('admin:create-user')
            ->expectsQuestion('Name', 'Test Admin')
            ->expectsQuestion('Email', 'admin@example.com')
            ->expectsQuestion('Password', 'password123')
            ->assertSuccessful();

        $user = User::where('email', 'admin@example.com')->first();

        $this->assertNotNull($user);
        $this->assertTrue($user->hasRole('Super Admin'));
        $this->assertTrue($user->hasVerifiedEmail());
    }
}
