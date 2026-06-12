<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminUserManagementTest extends TestCase
{
    use RefreshDatabase;

    private function superAdmin(): User
    {
        $this->seed(RolePermissionSeeder::class);

        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $user->assignRole('Super Admin');

        return $user;
    }

    public function test_super_admin_can_create_user_with_role(): void
    {
        $admin = $this->superAdmin();

        Role::findOrCreate('Admin');

        $this->actingAs($admin)
            ->post(route('users.store'), [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => 'password123',
                'password_confirmation' => 'password123',
                'email_verified' => '1',
                'roles' => ['Admin'],
            ])
            ->assertRedirect(route('users.index'));

        $user = User::where('email', 'test@example.com')->first();

        $this->assertNotNull($user);
        $this->assertTrue($user->hasRole('Admin'));
        $this->assertNotNull($user->email_verified_at);
    }

    public function test_super_admin_can_update_user(): void
    {
        $admin = $this->superAdmin();

        Role::findOrCreate('Admin');

        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $this->actingAs($admin)
            ->put(route('users.update', $user), [
                'name' => 'Updated User',
                'email' => 'updated@example.com',
                'password' => '',
                'password_confirmation' => '',
                'email_verified' => '1',
                'roles' => ['Admin'],
            ])
            ->assertRedirect(route('users.index'));

        $user->refresh();

        $this->assertSame('Updated User', $user->name);
        $this->assertSame('updated@example.com', $user->email);
        $this->assertTrue($user->hasRole('Admin'));
        $this->assertNotNull($user->email_verified_at);
    }

    public function test_super_admin_cannot_delete_own_account(): void
    {
        $admin = $this->superAdmin();

        $this->actingAs($admin)
            ->delete(route('users.destroy', $admin))
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'id' => $admin->id,
        ]);
    }

    public function test_super_admin_cannot_delete_last_super_admin_user(): void
    {
        $admin = $this->superAdmin();

        $otherUser = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $otherUser->assignRole('Super Admin');

        $admin->removeRole('Super Admin');

        $this->actingAs($otherUser)
            ->delete(route('users.destroy', $otherUser))
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'id' => $otherUser->id,
        ]);
    }
}
