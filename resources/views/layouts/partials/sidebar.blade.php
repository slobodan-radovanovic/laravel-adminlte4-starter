<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}" class="brand-link">
            <span class="brand-text fw-light">
                {{ config('adminlte.name', config('app.name')) }}
            </span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="menu"
                data-accordion="false">
                @foreach (config('adminlte.menu', []) as $item)
                    @include('layouts.partials.sidebar-item', ['item' => $item])
                @endforeach
            </ul>
        </nav>
    </div>
</aside>
