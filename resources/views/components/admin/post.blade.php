@props([
    'image',
    'name',
    'url' => null,
    'description' => null,
    'footer' => null,
])

{{-- Social-style post: author block, content (slot) and optional footer with actions. --}}
<div {{ $attributes->merge(['class' => 'post']) }}>
    <x-admin.user-block :image="$image" :name="$name" :url="$url" :description="$description" />

    <div class="mb-2">
        {{ $slot }}
    </div>

    @if ($footer)
        <div class="text-secondary small">
            {{ $footer }}
        </div>
    @endif
</div>
