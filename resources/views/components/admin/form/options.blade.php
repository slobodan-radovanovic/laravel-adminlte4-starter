@props([
    'options' => [],
    'selected' => null,
    'placeholder' => null,
])

{{-- Renders <option> tags. Options may be grouped: ['Group' => ['value' => 'Label']]. --}}
@php
    $selectedValues = array_map('strval', (array) $selected);
@endphp

@if ($placeholder !== null)
    <option value="">{{ $placeholder }}</option>
@endif

@foreach ($options as $optionValue => $optionLabel)
    @if (is_array($optionLabel))
        <optgroup label="{{ $optionValue }}">
            @foreach ($optionLabel as $groupValue => $groupLabel)
                <option value="{{ $groupValue }}" @selected(in_array((string) $groupValue, $selectedValues, true))>{{ $groupLabel }}</option>
            @endforeach
        </optgroup>
    @else
        <option value="{{ $optionValue }}" @selected(in_array((string) $optionValue, $selectedValues, true))>{{ $optionLabel }}</option>
    @endif
@endforeach
