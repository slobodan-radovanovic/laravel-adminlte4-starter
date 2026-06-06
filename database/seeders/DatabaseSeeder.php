<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
{
    $this->call([
        RolePermissionSeeder::class,
    ]);

    $user = User::query()->first();

    if ($user) {
        $user->assignRole('Super Admin');
    }
}
}
