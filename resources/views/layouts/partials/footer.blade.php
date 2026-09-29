<footer class="app-footer">
    <div class="float-end d-none d-sm-inline">
        {{ config('adminlte.footer.text', 'AdminLTE 4 Starter') }}

        @if (config('adminlte.footer.version'))
            <span class="ms-2">v{{ config('adminlte.footer.version') }}</span>
        @endif
    </div>

    <strong>
        Copyright &copy; {{ date('Y') }}
        @if ($footerUrl = config('adminlte.footer.url'))
            <a href="{{ $footerUrl }}" class="text-decoration-none" target="_blank" rel="noopener">
                {{ config('adminlte.name', config('app.name', 'Laravel')) }}
            </a>.
        @else
            {{ config('adminlte.name', config('app.name', 'Laravel')) }}.
        @endif
    </strong>

    All rights reserved.
</footer>
