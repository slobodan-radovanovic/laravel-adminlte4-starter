<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ColorModeTest extends TestCase
{
    use RefreshDatabase;

    public function test_navbar_offers_configured_color_modes(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('data-bs-theme-value="light"', false)
            ->assertSee('data-bs-theme-value="dark"', false)
            ->assertSee('data-bs-theme-value="auto"', false)
            ->assertDontSee('admin-theme-toggle', false);
    }

    public function test_navbar_only_offers_available_color_modes(): void
    {
        config(['adminlte.theme.available' => ['light', 'dark']]);

        $this->actingAs(User::factory()->create())
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('data-bs-theme-value="dark"', false)
            ->assertDontSee('data-bs-theme-value="auto"', false);
    }

    public function test_color_mode_switch_is_hidden_with_a_single_mode(): void
    {
        config(['adminlte.theme.available' => ['dark'], 'adminlte.theme.default' => 'dark']);

        $this->actingAs(User::factory()->create())
            ->get(route('dashboard'))
            ->assertOk()
            ->assertDontSee('data-bs-theme-value', false)
            ->assertSee('var fallback = "dark";', false);
    }

    public function test_guest_pages_apply_the_default_color_mode(): void
    {
        config(['adminlte.theme.default' => 'auto']);

        $this->get(route('login'))
            ->assertOk()
            ->assertSee('var fallback = "auto";', false);
    }
}
