<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view users',

            'view categories',
            'create categories',
            'edit categories',
            'delete categories',

            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        $superAdmin = Role::findOrCreate('Super Admin');
        $admin = Role::findOrCreate('Admin');

        $superAdmin->givePermissionTo(Permission::all());

        $admin->givePermissionTo([
            'view users',

            'view categories',
            'create categories',
            'edit categories',
            'delete categories',

            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
        ]);
    }
}
