@props([
    'name',
    'description' => null,
    'image' => null,
    'theme' => 'info',
    'layout' => 'columns',
])

{{--
    AdminLTE user profile widget.
    layout "columns": centered avatar, slot holds <x-admin.profile-col-item> stats in a row.
    layout "list": avatar on the left, slot holds <x-admin.profile-row-item> links.
--}}
@if ($layout === 'list')
    <div {{ $attributes->merge(['class' => 'card card-widget widget-user-2']) }}>
        <div class="widget-user-header text-bg-{{ $theme }}">
            @if ($image)
                <div class="widget-user-image">
                    <img class="rounded-circle shadow" src="{{ $image }}" alt="{{ $name }}">
                </div>
            @endif

            <h3 class="widget-user-username">{{ $name }}</h3>

            @if ($description)
                <h5 class="widget-user-desc">{{ $description }}</h5>
            @endif
        </div>

        <div class="card-footer p-0">
            <ul class="nav flex-column">
                {{ $slot }}
            </ul>
        </div>
    </div>
@else
    <div {{ $attributes->merge(['class' => 'card card-widget widget-user']) }}>
        <div class="widget-user-header text-bg-{{ $theme }}">
            <h3 class="widget-user-username">{{ $name }}</h3>

            @if ($description)
                <h5 class="widget-user-desc">{{ $description }}</h5>
            @endif
        </div>

        @if ($image)
            <div class="widget-user-image">
                <img class="rounded-circle shadow" src="{{ $image }}" alt="{{ $name }}">
            </div>
        @endif

        <div class="card-footer">
            <div class="row">
                {{ $slot }}
            </div>
        </div>
    </div>
@endif
