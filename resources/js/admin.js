import * as bootstrap from 'bootstrap';
// AdminLTE includes ColorMode, which powers the light, dark and auto switch in the navbar.
import 'admin-lte/dist/js/adminlte.js';
import $ from 'jquery';

window.bootstrap = bootstrap;
window.$ = window.jQuery = $;

/*
 * Plugins are split into separate chunks and loaded only when they are enabled
 * in config/adminlte.php or pushed to the "plugins" stack of the current page.
 */
const pluginLoaders = {
    datatables: async () => {
        const [{ default: DataTable }] = await Promise.all([
            import('datatables.net-bs5'),
            import('datatables.net-bs5/css/dataTables.bootstrap5.css'),
        ]);

        window.DataTable = DataTable;
    },

    select2: async () => {
        const [{ default: select2 }] = await Promise.all([
            import('select2'),
            import('select2/dist/css/select2.css'),
            import('select2-bootstrap-5-theme/dist/select2-bootstrap-5-theme.css'),
        ]);

        select2($);
    },

    chartjs: async () => {
        const { default: Chart } = await import('chart.js/auto');

        window.Chart = Chart;
    },

    flatpickr: async () => {
        const [{ default: flatpickr }] = await Promise.all([
            import('flatpickr'),
            import('flatpickr/dist/flatpickr.css'),
        ]);

        window.flatpickr = flatpickr;
    },

    sweetalert2: async () => {
        const { default: Swal } = await import('sweetalert2');

        window.Swal = Swal;
    },

    inputmask: async () => {
        const { default: Inputmask } = await import('inputmask');

        window.Inputmask = Inputmask;
    },

    sortablejs: async () => {
        const { default: Sortable } = await import('sortablejs');

        window.Sortable = Sortable;
    },

    dropzone: async () => {
        const [{ default: Dropzone }] = await Promise.all([
            import('dropzone'),
            import('dropzone/dist/dropzone.css'),
        ]);

        Dropzone.autoDiscover = false;
        window.Dropzone = Dropzone;
    },
};

const enabledPlugins = Array.isArray(window.AdminPlugins) ? window.AdminPlugins : [];

window.adminPluginEnabled = function (plugin) {
    return enabledPlugins.includes(plugin);
};

const pluginsReady = Promise.all(
    enabledPlugins
        .filter((plugin) => pluginLoaders[plugin])
        .map((plugin) => pluginLoaders[plugin]().catch((error) => {
            console.error(`Failed to load admin plugin "${plugin}".`, error);
        })),
);

const domReady = new Promise((resolve) => {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', resolve, { once: true });
    } else {
        resolve();
    }
});

const adminReady = Promise.all([domReady, pluginsReady]);

// Callbacks queued by page scripts before this module ran (see layouts/partials/plugins.blade.php).
window.adminReady = function (callback) {
    adminReady.then(() => callback());
};

(window.__adminReadyQueue || []).forEach((callback) => window.adminReady(callback));
delete window.__adminReadyQueue;

function initFlash() {
    const flash = document.querySelector('[data-admin-flash]');

    if (!flash) {
        return;
    }

    const close = function () {
        flash.remove();
    };

    flash.querySelector('[data-admin-flash-close]')?.addEventListener('click', close);

    flash.addEventListener('click', function (event) {
        if (event.target === flash) {
            close();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            close();
        }
    });

    const delay = Number(flash.dataset.adminFlashDelay || 3000);

    if (delay > 0) {
        setTimeout(close, delay);
    }
}

domReady.then(initFlash);
