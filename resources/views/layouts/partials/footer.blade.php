<footer class="app-footer">
    <div class="float-end d-none d-sm-inline">
        {{ config('adminlte.footer.text', 'AdminLTE 4 Starter') }}

        @if (config('adminlte.footer.version'))
            <span class="ms-2">v{{ config('adminlte.footer.version') }}</span>
        @endif
    </div>

    <strong>
        Copyright &copy; {{ date('Y') }}
        <a href="{{ route('dashboard') }}" class="text-decoration-none">
            {{ config('adminlte.name', config('app.name', 'Laravel')) }}
        </a>.
    </strong>

    All rights reserved.
</footer>
