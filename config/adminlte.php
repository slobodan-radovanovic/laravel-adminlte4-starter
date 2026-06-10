<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    */

    'name' => env('APP_NAME', 'AdminLTE Starter'),

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Title
    |--------------------------------------------------------------------------
    */

    'title' => env('APP_NAME', 'AdminLTE Starter'),

    /*
    |--------------------------------------------------------------------------
    | Theme Options
    |--------------------------------------------------------------------------
    */

    'theme' => [
        'default' => 'light',
        'available' => [
            'light',
            'dark',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Layout Options
    |--------------------------------------------------------------------------
    */

    'layout' => [
        'fixed' => true,
        'navbar_fixed' => false,
        'footer_fixed' => false,
        'sidebar_mini' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Navbar Options
    |--------------------------------------------------------------------------
    */

    'navbar' => [
        'theme' => 'body',
    ],

    /*
    |--------------------------------------------------------------------------
    | Sidebar Options
    |--------------------------------------------------------------------------
    */

    'sidebar' => [
        'theme' => 'dark',
        'collapsed' => false,
        'brand_logo' => null,
        'brand_text' => env('APP_NAME', 'AdminLTE Starter'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Footer Options
    |--------------------------------------------------------------------------
    */

    'footer' => [
        'enabled' => true,
        'text' => 'AdminLTE 4 Starter',
        'version' => '1.0.0',
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins
    |--------------------------------------------------------------------------
    */

    'plugins' => [
        'datatables' => [
            'enabled' => false,
        ],

        'select2' => [
            'enabled' => false,
        ],

        'chartjs' => [
            'enabled' => false,
        ],

        'flatpickr' => [
            'enabled' => false,
        ],

        'sweetalert2' => [
            'enabled' => false,
        ],

        'inputmask' => [
            'enabled' => false,
        ],

        'sortablejs' => [
            'enabled' => false,
        ],

        'dropzone' => [
            'enabled' => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu
    |--------------------------------------------------------------------------
    */

    'menu' => [
        [
            'text' => 'MAIN NAVIGATION',
            'header' => true,
        ],

        [
            'text' => 'Dashboard',
            'route' => 'dashboard',
            'icon' => 'bi bi-speedometer2',
            'active' => ['dashboard'],
        ],

        [
            'text' => 'ACCESS CONTROL',
            'header' => true,
        ],

        [
            'text' => 'Access Control',
            'icon' => 'bi bi-shield-lock',
            'can_any' => ['view users', 'view roles'],
            'active' => ['users.*', 'roles.*'],
            'submenu' => [
                [
                    'text' => 'Users',
                    'route' => 'users.index',
                    'icon' => 'bi bi-people',
                    'can' => 'view users',
                    'active' => ['users.*'],
                ],
                [
                    'text' => 'Roles',
                    'route' => 'roles.index',
                    'icon' => 'bi bi-shield-lock',
                    'can' => 'view roles',
                    'active' => ['roles.*'],
                ],
            ],
        ],

        [
            'text' => 'EXAMPLES',
            'header' => true,
        ],

        [
            'text' => 'Categories',
            'route' => 'categories.index',
            'icon' => 'bi bi-tags',
            'can' => 'view categories',
            'active' => ['categories.*'],
        ],

        [
            'text' => 'Plugins',
            'route' => 'examples.plugins',
            'icon' => 'bi bi-puzzle',
            'can' => 'view users',
            'active' => ['examples.plugins'],
        ],

        [
            'text' => 'AdminLTE Docs',
            'url' => 'https://adminlte.io/docs/4.0/',
            'icon' => 'bi bi-book',
            'target' => '_blank',
            'badge' => [
                'text' => 'Docs',
                'class' => 'text-bg-info',
            ],
        ],
    ],

];
