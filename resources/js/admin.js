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
            // AdminLTE's Select2 theme matches Bootstrap form controls, including dark mode.
            import('admin-lte/dist/css/adminlte-select2.css'),
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

    tomselect: async () => {
        const [{ default: TomSelect }] = await Promise.all([
            import('tom-select'),
            import('tom-select/dist/css/tom-select.bootstrap5.css'),
        ]);

        window.TomSelect = TomSelect;
    },

    quill: async () => {
        const [{ default: Quill }] = await Promise.all([
            import('quill'),
            import('quill/dist/quill.snow.css'),
        ]);

        window.Quill = Quill;
    },

    tinymce: async () => {
        const { default: tinymce } = await import('tinymce');

        // TinyMCE loads these by URL by default; importing them bundles everything with Vite.
        await Promise.all([
            import('tinymce/models/dom'),
            import('tinymce/themes/silver'),
            import('tinymce/icons/default'),
            import('tinymce/skins/ui/oxide/skin.js'),
            import('tinymce/skins/ui/oxide/content.js'),
            import('tinymce/skins/ui/oxide-dark/skin.js'),
            import('tinymce/skins/ui/oxide-dark/content.js'),
            import('tinymce/skins/content/default/content.js'),
            import('tinymce/skins/content/dark/content.js'),
            import('tinymce/plugins/advlist'),
            import('tinymce/plugins/autolink'),
            import('tinymce/plugins/code'),
            import('tinymce/plugins/fullscreen'),
            import('tinymce/plugins/image'),
            import('tinymce/plugins/link'),
            import('tinymce/plugins/lists'),
            import('tinymce/plugins/table'),
            import('tinymce/plugins/wordcount'),
        ]);

        window.tinymce = tinymce;
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

/*
 * Blade components in resources/views/components/admin mark their elements with
 * data-admin-* attributes (JSON options). This starts the matching plugins.
 * Call window.adminInitComponents(element) after inserting new component HTML.
 */
function readOptions(element, attribute) {
    try {
        return JSON.parse(element.getAttribute(attribute) || '{}');
    } catch {
        return {};
    }
}

function eachUninitialized(root, attribute, callback) {
    root.querySelectorAll(`[${attribute}]`).forEach((element) => {
        if (element.adminInitialized) {
            return;
        }

        element.adminInitialized = true;

        try {
            callback(element, readOptions(element, attribute));
        } catch (error) {
            console.error(`Failed to initialize [${attribute}].`, element, error);
        }
    });
}

const csrfToken = () => document.querySelector('meta[name="csrf-token"]')?.content;

const isDarkMode = () => document.documentElement.getAttribute('data-bs-theme') === 'dark';

/*
 * Laravel Filemanager (UniSharp). The layout sets <meta name="admin-file-manager"> for users
 * with the "use filemanager" permission. window.adminOpenFileManager({ type, onSelect }) opens
 * it in a modal; onSelect receives the chosen items ({ url, name, thumb_url, ... }).
 */
const fileManagerUrl = () => document.querySelector('meta[name="admin-file-manager"]')?.content;

function fileManagerLink(type, params = {}) {
    const url = new URL(fileManagerUrl(), window.location.origin);

    url.searchParams.set('type', type);
    Object.entries(params).forEach(([key, value]) => url.searchParams.set(key, value));

    return url.toString();
}

function openFileManager({ type = 'file', onSelect }) {
    if (!fileManagerUrl()) {
        return;
    }

    let modal = document.getElementById('admin-file-manager-modal');

    if (!modal) {
        modal = document.createElement('div');
        modal.id = 'admin-file-manager-modal';
        modal.className = 'modal fade';
        modal.tabIndex = -1;
        modal.setAttribute('aria-label', 'File manager');
        modal.innerHTML = `
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="bi bi-folder2-open me-1"></i>File manager</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <iframe title="File manager" class="d-block w-100 border-0" style="height: 70vh"></iframe>
                    </div>
                </div>
            </div>`;
        document.body.appendChild(modal);
    }

    const instance = bootstrap.Modal.getOrCreateInstance(modal);

    // The file manager calls parent[callback](items) when a file is chosen.
    window.adminFileManagerSelect = (items) => {
        onSelect?.(items);
        instance.hide();
    };

    modal.querySelector('iframe').src = fileManagerLink(type, { callback: 'adminFileManagerSelect' });
    instance.show();
}

window.adminOpenFileManager = openFileManager;

// <x-admin.form.file-picker> buttons.
document.addEventListener('click', (event) => {
    const button = event.target.closest('[data-admin-file-picker]');

    if (!button) {
        return;
    }

    const { type, input, preview } = readOptions(button, 'data-admin-file-picker');

    openFileManager({
        type,
        onSelect: (items) => {
            const field = document.querySelector(input);
            const previewElement = preview && document.querySelector(preview);

            field.value = items.map((item) => item.url).join(',');
            field.dispatchEvent(new Event('change', { bubbles: true }));

            if (previewElement && type === 'image') {
                previewElement.replaceChildren(...items.map((item) => Object.assign(document.createElement('img'), {
                    src: item.thumb_url || item.url,
                    alt: item.name || '',
                    className: 'img-thumbnail',
                    style: 'height: 5rem',
                })));
            }
        },
    });
});

function initTinymce(element, options) {
    element.adminTinymceOptions = options;

    return window.tinymce.init({
        target: element,
        skin: isDarkMode() ? 'oxide-dark' : 'oxide',
        content_css: isDarkMode() ? 'dark' : 'default',
        menubar: false,
        branding: false,
        promotion: false,
        plugins: 'advlist autolink code fullscreen image link lists table wordcount',
        toolbar: 'undo redo | blocks | bold italic underline | bullist numlist | link image table | code fullscreen',
        // "Browse" buttons in the image and link dialogs open Laravel Filemanager.
        file_picker_callback: fileManagerUrl()
            ? (callback, value, meta) => window.tinymce.activeEditor.windowManager.openUrl({
                title: 'File manager',
                url: fileManagerLink(meta.filetype === 'image' ? 'image' : 'file', { editor: meta.fieldname }),
                width: Math.round(window.innerWidth * 0.8),
                height: Math.round(window.innerHeight * 0.8),
                onMessage: (api, message) => callback(message.content),
            })
            : undefined,
        ...options,
    });
}

// TinyMCE cannot switch skins on the fly, so editors are recreated when the color mode changes.
new MutationObserver(() => {
    window.tinymce?.get().forEach((editor) => {
        const element = editor.getElement();

        editor.save();
        editor.remove();
        initTinymce(element, element.adminTinymceOptions);
    });
}).observe(document.documentElement, { attributes: true, attributeFilter: ['data-bs-theme'] });

function initAdminComponents(root = document) {
    if (window.DataTable) {
        eachUninitialized(root, 'data-admin-datatable', (element, options) => new window.DataTable(element, options));
    }

    if ($.fn.select2) {
        eachUninitialized(root, 'data-admin-select2', (element, options) => {
            const modal = element.closest('.modal');

            $(element).select2({
                width: '100%',
                dropdownParent: modal ? $(modal) : undefined,
                ...options,
            });
        });
    }

    if (window.TomSelect) {
        eachUninitialized(root, 'data-admin-tomselect', (element, options) => new window.TomSelect(element, options));
    }

    if (window.flatpickr) {
        eachUninitialized(root, 'data-admin-flatpickr', (element, options) => window.flatpickr(element, options));
    }

    if (window.Inputmask) {
        eachUninitialized(root, 'data-admin-inputmask', (element, options) => window.Inputmask(options).mask(element));
    }

    if (window.Dropzone) {
        eachUninitialized(root, 'data-admin-dropzone', (element, { field, ...options }) => {
            const dropzone = new window.Dropzone(element, {
                headers: { 'X-CSRF-TOKEN': csrfToken() },
                ...options,
            });
            const form = element.closest('form');

            // Keep a hidden input with the stored path of every uploaded file.
            dropzone.on('success', (file, response) => {
                if (!form || !field || !response?.path) {
                    return;
                }

                file.adminInput = Object.assign(document.createElement('input'), {
                    type: 'hidden',
                    name: field,
                    value: response.path,
                });
                form.appendChild(file.adminInput);
            });

            dropzone.on('removedfile', (file) => file.adminInput?.remove());
        });
    }

    if (window.Quill) {
        eachUninitialized(root, 'data-admin-quill', (element, { input, ...options }) => {
            const field = document.querySelector(input);
            const quill = new window.Quill(element, { theme: 'snow', ...options });

            // With access to the file manager, the image button picks an image from it.
            if (fileManagerUrl()) {
                quill.getModule('toolbar')?.addHandler('image', () => openFileManager({
                    type: 'image',
                    onSelect: ([item]) => {
                        const range = quill.getSelection(true);

                        quill.insertEmbed(range.index, 'image', item.url, 'user');
                        quill.setSelection(range.index + 1, 0);
                    },
                }));
            }

            // Load the saved HTML through Quill's clipboard, which turns it into editor content.
            if (field?.value) {
                quill.setContents(quill.clipboard.convert({ html: field.value }), 'silent');
            }

            quill.on('text-change', () => {
                if (field) {
                    const html = quill.root.innerHTML;

                    // An empty editor still contains an empty paragraph; submit it as an empty value.
                    field.value = html === '<p><br></p>' ? '' : html;
                }
            });
        });
    }

    if (window.tinymce) {
        eachUninitialized(root, 'data-admin-tinymce', (element, options) => initTinymce(element, options));
    }

    // Live value next to range and color inputs.
    eachUninitialized(root, 'data-admin-output', (element) => {
        const output = document.querySelector(element.getAttribute('data-admin-output'));
        const update = () => {
            if (output) {
                output.textContent = element.value;
            }
        };

        element.addEventListener('input', update);
        update();
    });

    eachUninitialized(root, 'data-admin-toast-autoshow', (element) => bootstrap.Toast.getOrCreateInstance(element).show());

    // Notification counters that refresh from a JSON endpoint: {"count": 3}.
    eachUninitialized(root, 'data-admin-notification', (element, { url, period = 60 }) => {
        const refresh = async () => {
            try {
                const response = await fetch(url, { headers: { Accept: 'application/json' } });
                const { count = 0 } = await response.json();

                element.querySelectorAll('[data-admin-notification-count]').forEach((badge) => {
                    badge.textContent = count;
                    badge.classList.toggle('d-none', !count);
                });
                element.querySelectorAll('[data-admin-notification-count-text]').forEach((text) => {
                    text.textContent = count;
                });
            } catch (error) {
                console.error('Failed to refresh notifications.', error);
            }
        };

        refresh();
        setInterval(refresh, Math.max(10, period) * 1000);
    });
}

window.adminInitComponents = initAdminComponents;

adminReady.then(() => initAdminComponents());

// Buttons with data-admin-toast="#toast-id" show that toast.
document.addEventListener('click', (event) => {
    const trigger = event.target.closest('[data-admin-toast]');
    const toast = trigger && document.querySelector(trigger.getAttribute('data-admin-toast'));

    if (toast) {
        bootstrap.Toast.getOrCreateInstance(toast).show();
    }
});

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
