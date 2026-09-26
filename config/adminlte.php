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
