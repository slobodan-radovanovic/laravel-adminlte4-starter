@props([
    'id',
    'title' => null,
    'icon' => null,
    'size' => null,
    'theme' => null,
    'centered' => false,
    'scrollable' => false,
    'staticBackdrop' => false,
    'footer' => null,
])

{{--
    Bootstrap modal. Open it with any element that has data-bs-toggle="modal" data-bs-target="#{id}".
    size: sm, lg, xl or fullscreen. The footer slot defaults to a Close button.
--}}
@php
    $dialogClasses = collect([
        'modal-dialog',
        $size === 'fullscreen' ? 'modal-fullscreen' : ($size ? 'modal-'.$size : null),
        $centered ? 'modal-dialog-centered' : null,
        $scrollable ? 'modal-dialog-scrollable' : null,
    ])->filter()->implode(' ');
@endphp

<div id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}-title" aria-hidden="true"
     @if ($staticBackdrop) data-bs-backdrop="static" data-bs-keyboard="false" @endif
     {{ $attributes->merge(['class' => 'modal fade']) }}>
    <div class="{{ $dialogClasses }}">
        <div class="modal-content">
            <div class="modal-header {{ $theme ? 'text-bg-'.$theme : '' }}">
                <h5 class="modal-title" id="{{ $id }}-title">
                    @if ($icon)
                        <i class="{{ $icon }} me-1"></i>
                    @endif
                    {{ $title }}
                </h5>
                <button type="button" class="btn-close {{ in_array($theme, ['primary', 'secondary', 'success', 'danger', 'dark'], true) ? 'btn-close-white' : '' }}"
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {{ $slot }}
            </div>

            <div class="modal-footer">
                @if ($footer)
                    {{ $footer }}
                @else
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @endif
            </div>
        </div>
    </div>
</div>
