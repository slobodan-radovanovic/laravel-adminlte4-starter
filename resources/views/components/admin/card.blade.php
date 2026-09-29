@props([
    'title' => null,
    'icon' => null,
    'footer' => null,
    'tools' => null,
    'theme' => null,
    'outline' => false,
    'collapsible' => false,
    'collapsed' => false,
    'removable' => false,
    'maximizable' => false,
    'bodyClass' => null,
])

{{--
    AdminLTE card. theme: primary, success, ... ("outline" for a colored top border only).
    collapsible, removable and maximizable add the AdminLTE card tool buttons. "tools" slot adds your own.
--}}
@php
    $classes = collect([
        'card',
        $theme ? 'card-'.$theme : null,
        $theme && $outline ? 'card-outline' : null,
        $collapsed ? 'collapsed-card' : null,
    ])->filter()->implode(' ');
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    @if ($title || $tools || $collapsible || $removable || $maximizable)
        <div class="card-header">
            <h3 class="card-title mb-0">
                @if ($icon)
                    <i class="{{ $icon }} me-1"></i>
                @endif

                {{ $title }}
            </h3>

            @if ($tools || $collapsible || $removable || $maximizable)
                <div class="card-tools">
                    {{ $tools }}

                    @if ($collapsible)
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" aria-label="Collapse">
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                        </button>
                    @endif

                    @if ($maximizable)
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-maximize" aria-label="Maximize">
                            <i data-lte-icon="maximize" class="bi bi-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit"></i>
                        </button>
                    @endif

                    @if ($removable)
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" aria-label="Remove">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    @endif
                </div>
            @endif
        </div>
    @endif

    <div class="card-body {{ $bodyClass }}">
        {{ $slot }}
    </div>

    @if ($footer)
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endif
</div>
