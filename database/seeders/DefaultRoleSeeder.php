<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DefaultRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Admin',
                'is_default' => true,
            ],
            [
                'name' => 'member',
                'display_name' => 'Member',
                'is_default' => true,
            ],
            [
                'name' => 'player',
                'display_name' => 'player',
                'is_default' => true,
            ],
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }

        /** @var Role $adminRole */
        $adminRole = Role::whereName('admin')->first();
        $user = User::whereEmail('admin@adtsports.com')->first();
        /** @var User $user */
        $allPermission = Permission::pluck('name', 'id');

        $adminRole->givePermissionTo($allPermission);
        if ($user) {
            $user->assignRole($adminRole);
        }

    }
}
