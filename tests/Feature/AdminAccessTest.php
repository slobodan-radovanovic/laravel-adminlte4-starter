<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_dashboard(): void
    {
        $this->get(route('dashboard'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_access_dashboard(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk();
    }

    public function test_regular_user_cannot_access_users_page(): void
    {
        $this->seed(RolePermissionSeeder::class);

        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user)
            ->get(route('users.index'))
            ->assertForbidden();
    }

    public function test_super_admin_can_access_users_roles_and_categories(): void
    {
        $this->seed(RolePermissionSeeder::class);

        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $user->assignRole('Super Admin');

        $this->actingAs($user)
            ->get(route('users.index'))
            ->assertOk();

        $this->actingAs($user)
            ->get(route('roles.index'))
            ->assertOk();

        $this->actingAs($user)
            ->get(route('categories.index'))
            ->assertOk();
    }
}
