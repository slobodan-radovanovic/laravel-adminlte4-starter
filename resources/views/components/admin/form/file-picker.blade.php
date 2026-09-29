@props([
    'name',
    'label' => null,
    'value' => null,
    'type' => 'image',
    'placeholder' => null,
    'required' => false,
    'preview' => true,
    'help' => null,
])

{{--
    Text input with a "Browse" button that opens Laravel Filemanager in a modal.
    type: image or file. Selecting several files stores their URLs separated by commas.
    The button is disabled for users without the "use filemanager" permission.
--}}
@php
    $id = $attributes->get('id', $name);
    $errorName = trim(str_replace(['[', ']'], ['.', ''], $name), '.');
    $current = old($errorName, $value);
    $canBrowse = Route::has('unisharp.lfm.show') && auth()->user()?->can('use filemanager');
@endphp

<x-admin.form._field :id="$id" :name="$name" :label="$label" :required="$required" :help="$help" :error-name="$errorName">
    <div class="input-group {{ $errors->has($errorName) ? 'has-validation' : '' }}">
        <input
            id="{{ $id }}"
            name="{{ $name }}"
            type="text"
            value="{{ $current }}"
            placeholder="{{ $placeholder ?? ($type === 'image' ? 'Choose an image' : 'Choose a file') }}"
            @required($required)
            {{ $attributes->merge([
                'class' => 'form-control' . ($errors->has($errorName) ? ' is-invalid' : ''),
            ]) }}
        >

        <button
            type="button"
            class="btn btn-outline-secondary"
            data-admin-file-picker="{{ json_encode(['type' => $type, 'input' => '#'.$id, 'preview' => $preview ? '#'.$id.'-preview' : null]) }}"
            @disabled(! $canBrowse)
        >
            <i class="bi {{ $type === 'image' ? 'bi-image' : 'bi-folder2-open' }} me-1"></i>Browse
        </button>
    </div>

    @if ($preview)
        <div id="{{ $id }}-preview" class="d-flex flex-wrap gap-2 mt-2">
            @if ($type === 'image')
                @foreach (array_filter(explode(',', (string) $current)) as $url)
                    <img src="{{ $url }}" alt="" class="img-thumbnail" style="height: 5rem">
                @endforeach
            @endif
        </div>
    @endif
</x-admin.form._field>
