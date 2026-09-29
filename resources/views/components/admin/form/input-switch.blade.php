@props([
    'name',
    'label',
    'checked' => false,
    'value' => 1,
    'uncheckedValue' => 0,
    'help' => null,
])

{{-- On/off switch. Always submits a value: "value" when on, "uncheckedValue" when off. --}}
<x-admin.form.checkbox
    :name="$name"
    :label="$label"
    :checked="$checked"
    :value="$value"
    :unchecked-value="$uncheckedValue"
    :help="$help"
    :switch="true"
    {{ $attributes->merge(['role' => 'switch']) }}
/>
