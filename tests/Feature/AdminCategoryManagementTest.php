<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCategoryManagementTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        $this->seed(RolePermissionSeeder::class);

        $user = User::factory()->create();

        $user->assignRole('Admin');

        return $user;
    }

    public function test_admin_can_create_category_with_generated_slug(): void
    {
        $this->actingAs($this->admin())
            ->post(route('categories.store'), [
                'name' => 'Product News',
                'description' => 'Latest product updates.',
                'is_active' => '1',
            ])
            ->assertRedirect(route('categories.index'));

        $this->assertDatabaseHas('categories', [
            'name' => 'Product News',
            'slug' => 'product-news',
            'is_active' => true,
        ]);
    }

    public function test_category_slug_must_be_unique(): void
    {
        Category::query()->create([
            'name' => 'News',
            'slug' => 'news',
            'is_active' => true,
        ]);

        $this->actingAs($this->admin())
            ->post(route('categories.store'), [
                'name' => 'News',
            ])
            ->assertSessionHasErrors('slug');

        $this->assertSame(1, Category::query()->where('slug', 'news')->count());
    }

    public function test_admin_can_update_category(): void
    {
        $category = Category::query()->create([
            'name' => 'General',
            'slug' => 'general',
            'is_active' => true,
        ]);

        $this->actingAs($this->admin())
            ->put(route('categories.update', $category), [
                'name' => 'General Updates',
                'slug' => 'general-updates',
            ])
            ->assertRedirect(route('categories.index'));

        $category->refresh();

        $this->assertSame('General Updates', $category->name);
        $this->assertSame('general-updates', $category->slug);
        $this->assertFalse($category->is_active);
    }

    public function test_admin_can_delete_category(): void
    {
        $category = Category::query()->create([
            'name' => 'Archived',
            'slug' => 'archived',
            'is_active' => false,
        ]);

        $this->actingAs($this->admin())
            ->delete(route('categories.destroy', $category))
            ->assertRedirect(route('categories.index'));

        $this->assertModelMissing($category);
    }

    public function test_user_without_permission_cannot_change_categories(): void
    {
        $this->seed(RolePermissionSeeder::class);

        $user = User::factory()->create();

        $category = Category::query()->create([
            'name' => 'General',
            'slug' => 'general',
            'is_active' => true,
        ]);

        $this->actingAs($user)
            ->post(route('categories.store'), ['name' => 'Blocked'])
            ->assertForbidden();

        $this->actingAs($user)
            ->put(route('categories.update', $category), ['name' => 'Blocked'])
            ->assertForbidden();

        $this->actingAs($user)
            ->delete(route('categories.destroy', $category))
            ->assertForbidden();

        $this->assertModelExists($category);
    }
}
