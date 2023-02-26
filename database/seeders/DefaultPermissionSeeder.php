<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DefaultPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name'         => 'manage_categories',
                'display_name' => 'Manage Categories',
            ],
            [
                'name'         => 'manage_leagues',
                'display_name' => 'Manage Leagues',
            ],
            [
                'name'         => 'manage_matches',
                'display_name' => 'Manage Matches',
            ],
            [
                'name'         => 'manage_blog',
                'display_name' => 'Manage Blog',
            ],
            [
                'name'         => 'manage_settings',
                'display_name' => 'Manage Settings',
            ],
            [
                'name'         => 'manage_roles',
                'display_name' => 'Manage Roles',
            ],
            [
                'name'         => 'manage_user',
                'display_name' => 'Manage User',
            ],

        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
