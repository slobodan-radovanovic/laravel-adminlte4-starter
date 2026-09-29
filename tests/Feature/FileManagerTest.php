<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ViewErrorBag;
use Tests\TestCase;

class FileManagerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');

        $this->seed(RolePermissionSeeder::class);
    }

    private function admin(): User
    {
        $user = User::factory()->create();

        $user->assignRole('Admin');

        return $user;
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get(route('file-manager'))->assertRedirect(route('login'));
        $this->get(route('unisharp.lfm.show'))->assertRedirect(route('login'));
    }

    public function test_user_without_permission_cannot_use_the_file_manager(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('file-manager'))->assertForbidden();
        $this->actingAs($user)->get(route('unisharp.lfm.show'))->assertForbidden();

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertDontSee('name="admin-file-manager"', false)
            ->assertDontSee('File Manager');
    }

    public function test_admin_can_open_the_file_manager(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)
            ->get(route('file-manager'))
            ->assertOk()
            ->assertSee(route('unisharp.lfm.show', ['type' => 'file']), false)
            ->assertSee('name="admin-file-manager"', false);

        $this->actingAs($admin)
            ->get(route('unisharp.lfm.show', ['type' => 'image']))
            ->assertOk();
    }

    public function test_admin_can_upload_an_image(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)
            ->post(route('unisharp.lfm.upload'), [
                'upload' => [UploadedFile::fake()->image('photo.jpg', 200, 200)],
                'type' => 'image',
                'working_dir' => '/'.$admin->id,
            ], ['X-Requested-With' => 'XMLHttpRequest'])
            ->assertOk();

        $this->assertNotEmpty(Storage::disk('public')->allFiles('photos/'.$admin->id));
    }

    public function test_changing_files_requires_an_ajax_request(): void
    {
        $admin = $this->admin();
        $url = route('unisharp.lfm.getDelete', ['type' => 'image', 'working_dir' => '/'.$admin->id, 'items' => ['photo.jpg']]);

        $this->actingAs($admin)->get($url)->assertForbidden();

        $status = $this->actingAs($admin)
            ->get($url, ['X-Requested-With' => 'XMLHttpRequest'])
            ->getStatusCode();

        $this->assertNotSame(403, $status);
    }

    public function test_file_picker_is_disabled_without_permission(): void
    {
        view()->share('errors', new ViewErrorBag);

        $this->actingAs(User::factory()->create());
        $this->assertMatchesRegularExpression('/data-admin-file-picker="[^"]*"\s+disabled/', Blade::render('<x-admin.form.file-picker name="cover" />'));

        $this->actingAs($this->admin());
        $this->assertDoesNotMatchRegularExpression('/data-admin-file-picker="[^"]*"\s+disabled/', Blade::render('<x-admin.form.file-picker name="cover" />'));
    }
}
