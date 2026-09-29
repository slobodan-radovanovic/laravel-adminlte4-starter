<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ViewErrorBag;
use Tests\TestCase;

class AdminComponentsTest extends TestCase
{
    private function render(string $template, array $data = []): string
    {
        view()->share('errors', new ViewErrorBag);

        return Blade::render($template, $data);
    }

    public function test_select_supports_multiple_and_grouped_options(): void
    {
        $html = $this->render(
            '<x-admin.form.select name="tags[]" multiple :options="$options" :selected="[\'b\', \'c\']" />',
            ['options' => ['Group' => ['a' => 'A', 'b' => 'B'], 'c' => 'C']],
        );

        $this->assertStringContainsString('name="tags[]"', $html);
        $this->assertStringContainsString('id="tags"', $html);
        $this->assertStringContainsString('multiple', $html);
        $this->assertStringContainsString('<optgroup label="Group">', $html);
        $this->assertMatchesRegularExpression('/value="b"\s+selected/', $html);
        $this->assertMatchesRegularExpression('/value="c"\s+selected/', $html);
        $this->assertDoesNotMatchRegularExpression('/value="a"\s+selected/', $html);
    }

    public function test_input_renders_addons(): void
    {
        $html = $this->render('<x-admin.form.input name="site" prepend="https://" append=".com" />');

        $this->assertStringContainsString('input-group', $html);
        $this->assertStringContainsString('<span class="input-group-text">https://</span>', $html);
        $this->assertStringContainsString('<span class="input-group-text">.com</span>', $html);
    }

    public function test_password_input_never_repeats_its_value(): void
    {
        $html = $this->render('<x-admin.form.input name="password" type="password" value="secret" />');

        $this->assertStringContainsString('value=""', $html);
        $this->assertStringNotContainsString('secret', $html);
    }

    public function test_plugin_components_pass_options_as_json(): void
    {
        $html = $this->render('<x-admin.form.input-date name="day" time />');

        $this->assertStringContainsString('data-admin-flatpickr="{&quot;dateFormat&quot;:&quot;Y-m-d H:i&quot;', $html);
    }

    public function test_card_renders_tools(): void
    {
        $html = $this->render('<x-admin.card title="Stats" theme="primary" outline collapsible removable maximizable>Body</x-admin.card>');

        $this->assertStringContainsString('card card-primary card-outline', $html);
        $this->assertStringContainsString('data-lte-toggle="card-collapse"', $html);
        $this->assertStringContainsString('data-lte-toggle="card-remove"', $html);
        $this->assertStringContainsString('data-lte-toggle="card-maximize"', $html);
    }

    public function test_content_header_renders_breadcrumbs(): void
    {
        $html = $this->render('<x-admin.content-header title="Edit user" :breadcrumbs="[\'Users\' => \'/users\', \'Edit\']" />');

        $this->assertStringContainsString('<h1 class="mb-0">Edit user</h1>', $html);
        $this->assertStringContainsString('<a href="/users">Users</a>', $html);
        $this->assertStringContainsString('aria-current="page">Edit</li>', $html);
    }

    public function test_datatable_disables_sorting_for_unsortable_columns(): void
    {
        $html = $this->render('<x-admin.datatable id="t" :heads="[\'Name\', [\'label\' => \'Actions\', \'sortable\' => false]]" />');

        $this->assertStringContainsString('<th', $html);
        $this->assertStringContainsString('&quot;targets&quot;:1,&quot;orderable&quot;:false', $html);
    }

    public function test_timeline_item_without_content_renders_only_the_icon(): void
    {
        $html = $this->render('<x-admin.timeline-item icon="bi bi-clock" theme="secondary" />');

        $this->assertStringContainsString('timeline-icon bi bi-clock text-bg-secondary', $html);
        $this->assertStringNotContainsString('timeline-item', $html);
    }

    public function test_progress_clamps_its_value(): void
    {
        $html = $this->render('<x-admin.progress :value="150" />');

        $this->assertStringContainsString('width: 100%', $html);
    }

    public function test_every_component_view_compiles(): void
    {
        $components = collect(glob(resource_path('views/components/admin/{,*/}*.blade.php'), GLOB_BRACE))
            ->map(fn ($path) => str_replace([resource_path('views/components/').'', '.blade.php', '/'], ['', '', '.'], $path));

        $this->assertGreaterThanOrEqual(44, $components->reject(fn ($name) => str_contains($name, '._'))->count());

        foreach ($components as $component) {
            $this->assertTrue(view()->exists('components.'.$component), $component);
        }
    }
}
