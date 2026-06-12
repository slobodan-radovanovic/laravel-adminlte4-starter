<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminRoleManagementTest extends TestCase
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

    public function test_super_admin_can_create_role(): void
    {
        $admin = $this->superAdmin();

        $this->actingAs($admin)
            ->post(route('roles.store'), [
                'name' => 'Manager',
                'permissions' => ['view users'],
            ])
            ->assertRedirect(route('roles.index'));

        $role = Role::where('name', 'Manager')->first();

        $this->assertNotNull($role);
        $this->assertTrue($role->hasPermissionTo('view users'));
    }

    public function test_super_admin_can_update_role(): void
    {
        $admin = $this->superAdmin();

        $role = Role::findOrCreate('Manager');

        $this->actingAs($admin)
            ->put(route('roles.update', $role), [
                'name' => 'Content Manager',
                'permissions' => ['view categories'],
            ])
            ->assertRedirect(route('roles.index'));

        $role->refresh();

        $this->assertSame('Content Manager', $role->name);
        $this->assertTrue($role->hasPermissionTo('view categories'));
    }

    public function test_super_admin_role_cannot_be_deleted(): void
    {
        $admin = $this->superAdmin();

        $role = Role::findByName('Super Admin');

        $this->actingAs($admin)
            ->delete(route('roles.destroy', $role))
            ->assertRedirect(route('roles.index'));

        $this->assertDatabaseHas('roles', [
            'name' => 'Super Admin',
        ]);
    }
}
