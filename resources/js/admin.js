import 'bootstrap';
import 'admin-lte/dist/js/adminlte.js';

import $ from 'jquery';
import DataTable from 'datatables.net-bs5';
import select2 from 'select2';
import Chart from 'chart.js/auto';
import flatpickr from 'flatpickr';
import Swal from 'sweetalert2';
import Inputmask from 'inputmask/dist/inputmask.es6.js';
import Sortable from 'sortablejs';
import Dropzone from 'dropzone';

window.$ = window.jQuery = $;

window.DataTable = DataTable;
window.Chart = Chart;
window.flatpickr = flatpickr;
window.Swal = Swal;
window.Inputmask = Inputmask;
window.Sortable = Sortable;
window.Dropzone = Dropzone;

window.adminPluginEnabled = function (plugin) {
  return Array.isArray(window.AdminPlugins) && window.AdminPlugins.includes(plugin);
};

select2($);

Dropzone.autoDiscover = false;

const THEME_STORAGE_KEY = 'admin-theme';

function getStoredTheme() {
    return localStorage.getItem(THEME_STORAGE_KEY);
}

function getPreferredTheme() {
    return getStoredTheme() || document.documentElement.getAttribute('data-bs-theme') || 'light';
}

function setTheme(theme) {
    document.documentElement.setAttribute('data-bs-theme', theme);
    localStorage.setItem(THEME_STORAGE_KEY, theme);
    updateThemeIcon(theme);
}

function updateThemeIcon(theme) {
    const icon = document.getElementById('admin-theme-icon');

    if (!icon) {
        return;
    }

    icon.classList.remove('bi-sun', 'bi-moon-stars');

    if (theme === 'dark') {
        icon.classList.add('bi-sun');
        return;
    }

    icon.classList.add('bi-moon-stars');
}

function initThemeToggle() {
    const toggle = document.getElementById('admin-theme-toggle');

    if (!toggle) {
        return;
    }

    const currentTheme = getPreferredTheme();

    document.documentElement.setAttribute('data-bs-theme', currentTheme);
    updateThemeIcon(currentTheme);

    toggle.addEventListener('click', () => {
        const activeTheme = document.documentElement.getAttribute('data-bs-theme') || 'light';
        const nextTheme = activeTheme === 'dark' ? 'light' : 'dark';

        setTheme(nextTheme);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initThemeToggle();
});
