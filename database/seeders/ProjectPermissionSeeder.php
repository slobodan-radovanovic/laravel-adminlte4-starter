<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Project-specific permissions and roles.
 *
 * This seeder belongs to your project. Starter releases avoid changing it,
 * while RolePermissionSeeder keeps the starter's own permissions up to date.
 * Super Admins receive every permission automatically through Gate::before.
 */
class ProjectPermissionSeeder extends Seeder
{
    /**
     * @var array<int, string>
     */
    protected array $permissions = [
        // 'view invoices',
        // 'create invoices',
    ];

    /**
     * Additional permissions for existing or new roles.
     *
     * @var array<string, array<int, string>>
     */
    protected array $roles = [
        // 'Admin' => ['view invoices', 'create invoices'],
        // 'Accountant' => ['view invoices'],
    ];

    public function run(): void
    {
        foreach ($this->permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        foreach ($this->roles as $role => $permissions) {
            Role::findOrCreate($role)->givePermissionTo($permissions);
        }
    }
}
