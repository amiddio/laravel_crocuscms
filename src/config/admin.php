<?php

return [

    'admin_panel_prefix' => env('ADMIN_PANEL_PREFIX', 'admin_g4aw7t'),

    'super_admin_role_name' => env('SUPER_ADMIN_ROLE_NAME', 'Administrator'),

    'path' => [
        'admin_avatar' => 'admin/avatars',
    ],

    'main_nav_bar' => [
        'dashboard' => [
            'name' => 'Dashboard',
            'route' => 'admin.dashboard',
            'uri' => 'dashboard',
            'icon' => 'm4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5',
        ],
        'system' => [
            'name' => 'System',
            'icon' => 'M10 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h2m10 1a3 3 0 0 1-3 3m3-3a3 3 0 0 0-3-3m3 3h1m-4 3a3 3 0 0 1-3-3m3 3v1m-3-4a3 3 0 0 1 3-3m-3 3h-1m4-3v-1m-2.121 1.879-.707-.707m5.656 5.656-.707-.707m-4.242 0-.707.707m5.656-5.656-.707.707M12 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z',
            'items' => [
                [
                    'name' => 'Admins',
                    'route' => 'admin.admins.index',
                    'uri' => 'admins',
                ],
                [
                    'name' => 'Admin Roles',
                    'route' => 'admin.admin_roles.index',
                    'uri' => 'admin_roles',
                ],
                [
                    'name' => 'Admin Permissions',
                    'route' => 'admin.admin_permissions',
                    'uri' => 'admin_permissions',
                ],
                [
                    'name' => 'Versions',
                    'route' => 'admin.system_versions',
                    'uri' => 'system_versions',
                ],
            ],
        ],
    ],


];
