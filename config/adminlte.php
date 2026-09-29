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
    |
    | Color modes are handled by AdminLTE's built-in ColorMode. 'default' is
    | used until a user picks a mode: light, dark or auto (follows the
    | operating system). 'available' lists the modes offered in the navbar.
    |
    */

    'theme' => [
        'default' => 'light',
        'available' => [
            'light',
            'dark',
            'auto',
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
    |
    | 'url' is the target of the copyright link (null for plain text) and
    | 'version' is shown next to 'text'. In your project, set them to your
    | own website or repository and your application's version.
    |
    */

    'footer' => [
        'enabled' => true,
        'text' => 'AdminLTE 4 Starter',
        'url' => 'https://github.com/slobodan-radovanovic/laravel-adminlte4-starter',
        'version' => '2.3.1',
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
    | Authentication
    |--------------------------------------------------------------------------
    |
    | Disable public registration when accounts should only be created by
    | administrators or with the admin:create-user command.
    |
    */

    'auth' => [
        'registration' => env('ADMINLTE_REGISTRATION_ENABLED', true),
    ],

    'feedback' => [
        'type' => 'popup', // popup, toast, alert
        'auto_close' => true,
        'delay' => 3000,
    ],

];
