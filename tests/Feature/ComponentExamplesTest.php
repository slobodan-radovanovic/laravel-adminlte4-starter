<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ComponentExamplesTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        $this->seed(RolePermissionSeeder::class);

        $user = User::factory()->create();

        $user->assignRole('Admin');

        return $user;
    }

    public function test_component_example_pages_render(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)
            ->get(route('examples.components.forms'))
            ->assertOk()
            ->assertSee('data-admin-select2', false)
            ->assertSee('data-admin-tomselect', false)
            ->assertSee('data-admin-flatpickr', false)
            ->assertSee('data-admin-dropzone', false)
            ->assertSee('data-admin-quill', false)
            ->assertSee('data-admin-tinymce', false)
            ->assertSee('&quot;license_key&quot;:&quot;gpl&quot;', false)
            ->assertSee('window.AdminPlugins = ["select2","tomselect","flatpickr","dropzone","quill","tinymce"]', false);

        $this->actingAs($admin)
            ->get(route('examples.components.widgets'))
            ->assertOk()
            ->assertSee('direct-chat-msg end', false)
            ->assertSee('widget-user-2', false)
            ->assertSee('timeline-item', false)
            ->assertSee('ribbon-wrapper', false)
            ->assertSee('data-lte-toggle="card-collapse"', false);

        $this->actingAs($admin)
            ->get(route('examples.components.layout'))
            ->assertOk()
            ->assertSee('data-admin-datatable', false)
            ->assertSee('data-admin-notification', false)
            ->assertSee('modal-dialog modal-lg modal-dialog-centered', false)
            ->assertSee('&quot;orderable&quot;:false', false);
    }

    public function test_component_examples_require_permission(): void
    {
        $this->seed(RolePermissionSeeder::class);

        $this->actingAs(User::factory()->create())
            ->get(route('examples.components.forms'))
            ->assertForbidden();
    }

    public function test_example_form_shows_validation_errors(): void
    {
        $this->actingAs($this->admin())
            ->from(route('examples.components.forms'))
            ->post(route('examples.components.forms.submit'), ['accent' => 'red'])
            ->assertRedirect(route('examples.components.forms'))
            ->assertSessionHasErrors(['name', 'email', 'country', 'accent']);
    }

    public function test_example_form_accepts_valid_input(): void
    {
        $this->actingAs($this->admin())
            ->post(route('examples.components.forms.submit'), [
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'country' => 'rs',
                'languages' => ['php', 'js'],
                'tags' => ['laravel', 'new-tag'],
                'birthday' => '1990-05-01',
                'newsletter' => '1',
                'accent' => '#6f42c1',
                'volume' => '40',
                'content' => '<p>Hello</p>',
                'article' => '<p>Article</p>',
            ])
            ->assertRedirect(route('examples.components.forms'))
            ->assertSessionHas('submitted.languages', ['php', 'js'])
            ->assertSessionHas('submitted.tags', ['laravel', 'new-tag']);
    }

    public function test_example_upload_stores_file_and_returns_path(): void
    {
        Storage::fake();

        $response = $this->actingAs($this->admin())
            ->postJson(route('examples.components.upload'), [
                'file' => UploadedFile::fake()->image('photo.jpg'),
            ])
            ->assertOk()
            ->assertJsonStructure(['path']);

        Storage::assertExists($response->json('path'));
    }

    public function test_example_upload_rejects_other_file_types(): void
    {
        $this->actingAs($this->admin())
            ->post(route('examples.components.upload'), [
                'file' => UploadedFile::fake()->create('script.php', 1, 'text/x-php'),
            ], ['Accept' => 'application/json'])
            ->assertUnprocessable();
    }

    public function test_notification_counter_endpoint_returns_count(): void
    {
        $this->actingAs($this->admin())
            ->getJson(route('examples.components.notifications'))
            ->assertOk()
            ->assertJsonStructure(['count']);
    }
}
