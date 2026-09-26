<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SuperAdminProtectionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    private function userWithRole(string $role): User
    {
        $user = User::factory()->create();

        $user->assignRole($role);

        return $user;
    }

    public function test_super_admin_passes_permissions_added_after_seeding(): void
    {
        Permission::findOrCreate('export reports');

        $superAdmin = $this->userWithRole(User::SUPER_ADMIN_ROLE);

        $this->assertTrue($superAdmin->can('export reports'));
    }

    public function test_admin_cannot_create_super_admin_user(): void
    {
        $admin = $this->userWithRole('Admin');

        $this->actingAs($admin)
            ->post(route('users.store'), [
                'name' => 'Escalated User',
                'email' => 'escalated@example.com',
                'password' => 'password123',
                'password_confirmation' => 'password123',
                'roles' => [User::SUPER_ADMIN_ROLE],
            ])
            ->assertSessionHasErrors('roles.0');

        $this->assertDatabaseMissing('users', ['email' => 'escalated@example.com']);
    }

    public function test_admin_cannot_promote_user_to_super_admin(): void
    {
        $admin = $this->userWithRole('Admin');

        $this->actingAs($admin)
            ->put(route('users.update', $admin), [
                'name' => $admin->name,
                'email' => $admin->email,
                'roles' => ['Admin', User::SUPER_ADMIN_ROLE],
            ])
            ->assertSessionHasErrors('roles.1');

        $this->assertFalse($admin->fresh()->isSuperAdmin());
    }

    public function test_admin_cannot_edit_or_delete_super_admin_user(): void
    {
        $admin = $this->userWithRole('Admin');
        $superAdmin = $this->userWithRole(User::SUPER_ADMIN_ROLE);

        $this->actingAs($admin)
            ->get(route('users.edit', $superAdmin))
            ->assertForbidden();

        $this->actingAs($admin)
            ->put(route('users.update', $superAdmin), [
                'name' => 'Taken Over',
                'email' => 'taken-over@example.com',
                'password' => 'password123',
                'password_confirmation' => 'password123',
            ])
            ->assertForbidden();

        $this->actingAs($admin)
            ->delete(route('users.destroy', $superAdmin))
            ->assertForbidden();

        $this->assertDatabaseHas('users', [
            'id' => $superAdmin->id,
            'email' => $superAdmin->email,
        ]);
    }

    public function test_admin_does_not_see_super_admin_role_in_user_form(): void
    {
        $admin = $this->userWithRole('Admin');

        $this->actingAs($admin)
            ->get(route('users.create'))
            ->assertOk()
            ->assertDontSee('value="'.User::SUPER_ADMIN_ROLE.'"', false);
    }

    public function test_super_admin_can_assign_super_admin_role(): void
    {
        $superAdmin = $this->userWithRole(User::SUPER_ADMIN_ROLE);
        $user = $this->userWithRole('Admin');

        $this->actingAs($superAdmin)
            ->put(route('users.update', $user), [
                'name' => $user->name,
                'email' => $user->email,
                'email_verified' => '1',
                'roles' => [User::SUPER_ADMIN_ROLE],
            ])
            ->assertRedirect(route('users.index'));

        $this->assertTrue($user->fresh()->isSuperAdmin());
    }

    public function test_super_admin_role_cannot_be_edited(): void
    {
        $superAdmin = $this->userWithRole(User::SUPER_ADMIN_ROLE);
        $admin = $this->userWithRole('Admin');
        $role = Role::findByName(User::SUPER_ADMIN_ROLE);

        foreach ([$superAdmin, $admin] as $user) {
            $this->actingAs($user)
                ->get(route('roles.edit', $role))
                ->assertForbidden();

            $this->actingAs($user)
                ->put(route('roles.update', $role), [
                    'name' => 'Renamed',
                    'permissions' => [],
                ])
                ->assertForbidden();
        }

        $this->assertDatabaseHas('roles', ['name' => User::SUPER_ADMIN_ROLE]);
    }
}
