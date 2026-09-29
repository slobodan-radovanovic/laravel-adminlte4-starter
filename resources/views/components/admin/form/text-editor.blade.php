@props([
    'name',
    'label' => null,
    'value' => null,
    'placeholder' => null,
    'required' => false,
    'help' => null,
    'height' => '12rem',
    'toolbar' => null,
    'config' => [],
])

{{--
    Rich text editor powered by Quill. The HTML is submitted in "name".
    Always sanitize it before displaying it again (for example with an HTML purifier).
    toolbar: Quill toolbar option, for example [['bold', 'italic'], ['link']].
--}}
@php
    $id = $attributes->get('id', $name);
    $errorName = trim(str_replace(['[', ']'], ['.', ''], $name), '.');
    $config = array_merge(array_filter([
        'input' => '#'.$id.'-input',
        'placeholder' => $placeholder,
        'modules' => ['toolbar' => $toolbar ?? [
            [['header' => [2, 3, false]]],
            ['bold', 'italic', 'underline', 'strike'],
            [['list' => 'ordered'], ['list' => 'bullet']],
            ['link', 'image', 'blockquote', 'code-block'],
            ['clean'],
        ]],
    ]), $config);
@endphp

@push('plugins')
    quill
@endpush

<x-admin.form._field :id="$id" :name="$name" :label="$label" :required="$required" :help="$help" :error-name="$errorName">
    <input id="{{ $id }}-input" type="hidden" name="{{ $name }}" value="{{ old($errorName, $value) }}">

    <div class="admin-quill {{ $errors->has($errorName) ? 'is-invalid' : '' }}">
        <div
            id="{{ $id }}"
            data-admin-quill="{{ json_encode($config) }}"
            style="height: {{ $height }}"
            {{ $attributes }}
        ></div>
    </div>
</x-admin.form._field>
