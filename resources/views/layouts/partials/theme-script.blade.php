{{--
    Applies the saved color mode before the page renders, so there is no flash of the wrong theme.
    AdminLTE's built-in ColorMode (resources/js/admin.js) takes over once the page has loaded.
--}}
<script>
    (function () {
        var themes = ['light', 'dark', 'auto'];
        var fallback = @json(config('adminlte.theme.default', 'light'));
        var stored = null;

        try {
            stored = localStorage.getItem('lte-theme');

            // Carry over the choice saved by starter versions before 2.3.
            var legacy = localStorage.getItem('admin-theme');

            if (themes.indexOf(stored) === -1 && themes.indexOf(legacy) !== -1) {
                stored = legacy;
            }

            // AdminLTE only follows the operating system for a stored "auto" choice.
            if (themes.indexOf(stored) === -1 && fallback === 'auto') {
                stored = 'auto';
            }

            if (stored) {
                localStorage.setItem('lte-theme', stored);
            }

            localStorage.removeItem('admin-theme');
        } catch (e) {}

        var theme = themes.indexOf(stored) !== -1 ? stored : fallback;

        if (theme === 'auto') {
            theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }

        document.documentElement.setAttribute('data-bs-theme', theme);
    })();
</script>
