@props([
    'value',
    'trueText' => 'Active',
    'falseText' => 'Inactive',
    'trueClass' => 'text-bg-success',
    'falseClass' => 'text-bg-secondary',
])

<span class="badge {{ $value ? $trueClass : $falseClass }}">
    {{ $value ? $trueText : $falseText }}
</span>
