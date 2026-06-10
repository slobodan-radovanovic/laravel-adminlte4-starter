@php
    $configuredPlugins = config('adminlte.plugins', []);

    $pagePlugins = $pagePlugins ?? [];

    if (isset($__env)) {
        $stackedPlugins = trim($__env->yieldPushContent('plugins'));

        if ($stackedPlugins !== '') {
            $pagePlugins = array_merge(
                $pagePlugins,
                collect(explode("\n", $stackedPlugins))
                    ->map(fn ($plugin) => trim($plugin))
                    ->filter()
                    ->values()
                    ->all()
            );
        }
    }

    $enabledPlugins = collect($configuredPlugins)
        ->filter(fn ($plugin) => $plugin['enabled'] ?? false)
        ->keys()
        ->merge($pagePlugins)
        ->unique()
        ->values()
        ->all();
@endphp

<script>
    window.AdminPlugins = @json($enabledPlugins);
</script>
