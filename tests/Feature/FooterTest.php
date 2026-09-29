<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FooterTest extends TestCase
{
    use RefreshDatabase;

    public function test_footer_shows_configured_link_and_version(): void
    {
        config([
            'adminlte.footer.url' => 'https://example.com/project',
            'adminlte.footer.version' => '9.8.7',
        ]);

        $this->actingAs(User::factory()->create())
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('href="https://example.com/project"', false)
            ->assertSee('v9.8.7');
    }

    public function test_footer_can_be_disabled(): void
    {
        config(['adminlte.footer.enabled' => false]);

        $this->actingAs(User::factory()->create())
            ->get(route('dashboard'))
            ->assertOk()
            ->assertDontSee('app-footer', false);
    }

    public function test_starter_footer_version_matches_latest_changelog_release(): void
    {
        if (config('adminlte.footer.text') !== 'AdminLTE 4 Starter') {
            $this->markTestSkipped('Only applies to the starter itself, not to projects built from it.');
        }

        preg_match('/^## v(\d+\.\d+\.\d+)/m', file_get_contents(base_path('CHANGELOG.md')), $matches);

        $this->assertSame(
            $matches[1] ?? null,
            config('adminlte.footer.version'),
            'Update adminlte.footer.version when adding a release to CHANGELOG.md.',
        );
    }
}
