<?php

/*
|--------------------------------------------------------------------------
| Admin Sidebar Menu
|--------------------------------------------------------------------------
|
| This file belongs to your project. Starter releases avoid changing it, so
| you can customize the menu here without merge conflicts on updates.
|
| Item keys: text, route or url, icon, can, can_any, active, target,
| badge (text, class), submenu. Use 'header' => true for section headings.
|
*/

return [

    'items' => [
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
