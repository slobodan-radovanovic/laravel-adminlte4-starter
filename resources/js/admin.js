import 'bootstrap';
import 'admin-lte/dist/js/adminlte.js';

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
