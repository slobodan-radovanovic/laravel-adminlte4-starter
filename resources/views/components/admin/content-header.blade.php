@props([
    'title',
    'breadcrumbs' => [],
    'home' => true,
])

{{--
    Page title with breadcrumbs. Use inside @section('content_header').
    breadcrumbs: ['Users' => route('users.index'), 'Edit'] (the last item is the current page).
--}}
<div {{ $attributes->merge(['class' => 'row']) }}>
    <div class="col-sm-6">
        <h1 class="mb-0">{{ $title }}</h1>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            @if ($home)
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
            @endif

            @foreach ($breadcrumbs as $text => $url)
                @if (is_int($text))
                    <li class="breadcrumb-item active" aria-current="page">{{ $url }}</li>
                @else
                    <li class="breadcrumb-item"><a href="{{ $url }}">{{ $text }}</a></li>
                @endif
            @endforeach

            @if (empty($breadcrumbs))
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            @endif
        </ol>
    </div>
</div>
