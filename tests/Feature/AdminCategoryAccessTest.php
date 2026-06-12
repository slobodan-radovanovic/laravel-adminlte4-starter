<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCategoryAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_without_category_permission_cannot_access_categories(): void
    {
        $this->seed(RolePermissionSeeder::class);

        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user)
            ->get(route('categories.index'))
            ->assertForbidden();
    }

    public function test_super_admin_can_access_category_create_page(): void
    {
        $this->seed(RolePermissionSeeder::class);

        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $user->assignRole('Super Admin');

        $this->actingAs($user)
            ->get(route('categories.create'))
            ->assertOk();
    }
}
