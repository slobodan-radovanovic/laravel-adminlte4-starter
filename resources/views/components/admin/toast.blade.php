@props([
    'id',
    'title',
    'icon' => null,
    'theme' => null,
    'time' => null,
    'autoShow' => false,
    'autohide' => true,
    'delay' => 5000,
])

{{--
    Bootstrap toast. Show it with "autoShow" or with a button that has data-admin-toast="#{id}".
    Wrap several toasts in <div class="toast-container position-fixed top-0 end-0 p-3">.
--}}
<div id="{{ $id }}" role="alert" aria-live="assertive" aria-atomic="true"
     data-bs-autohide="{{ $autohide ? 'true' : 'false' }}" data-bs-delay="{{ $delay }}"
     @if ($autoShow) data-admin-toast-autoshow @endif
     {{ $attributes->merge(['class' => 'toast']) }}>
    <div class="toast-header {{ $theme ? 'text-bg-'.$theme : '' }}">
        @if ($icon)
            <i class="{{ $icon }} me-2"></i>
        @endif

        <strong class="me-auto">{{ $title }}</strong>

        @if ($time)
            <small>{{ $time }}</small>
        @endif

        <button type="button" class="btn-close {{ in_array($theme, ['primary', 'secondary', 'success', 'danger', 'dark'], true) ? 'btn-close-white' : '' }} ms-2"
                data-bs-dismiss="toast" aria-label="Close"></button>
    </div>

    <div class="toast-body">
        {{ $slot }}
    </div>
</div>
