<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DefaultPermissionSeeder::class);
        $this->call(DefaultSettingSeeder::class);
        $this->call(DefaultAdminSeeder::class);
        $this->call(DefaultRoleSeeder::class);
        $this->call(DefaultPaymentGatewaySeeder::class);
    }
}
