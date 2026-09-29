@props([
    'title',
    'text',
    'size' => 4,
    'border' => true,
])

{{-- A stat column in <x-admin.profile-widget layout="columns">. Omit the border on the last column. --}}
<div {{ $attributes->merge(['class' => 'col-sm-'.$size.($border ? ' border-end' : '')]) }}>
    <x-admin.profile-item :title="$title" :text="$text" />
</div>
