<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\ProjectPermissionSeeder;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ProjectCustomizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_sidebar_uses_admin_menu_config(): void
    {
        config(['admin-menu.items' => [
            [
                'text' => 'Project Reports',
                'url' => '/reports',
                'icon' => 'bi bi-graph-up',
            ],
        ]]);

        $this->actingAs(User::factory()->create())
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Project Reports')
            ->assertDontSee('Access Control');
    }

    public function test_legacy_adminlte_menu_still_takes_precedence(): void
    {
        config([
            'adminlte.menu' => [
                [
                    'text' => 'Legacy Menu Item',
                    'url' => '/legacy',
                    'icon' => 'bi bi-clock-history',
                ],
            ],
        ]);

        $this->actingAs(User::factory()->create())
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Legacy Menu Item')
            ->assertDontSee('Access Control');
    }

    public function test_project_permission_seeder_adds_permissions_to_roles(): void
    {
        $this->seed(RolePermissionSeeder::class);

        $seeder = new class extends ProjectPermissionSeeder
        {
            protected array $permissions = ['view invoices'];

            protected array $roles = [
                'Admin' => ['view invoices'],
                'Accountant' => ['view invoices'],
            ];
        };

        $seeder->run();

        $this->assertTrue(Role::findByName('Admin')->hasPermissionTo('view invoices'));
        $this->assertTrue(Role::findByName('Admin')->hasPermissionTo('view users'));
        $this->assertTrue(Role::findByName('Accountant')->hasPermissionTo('view invoices'));
    }
}
