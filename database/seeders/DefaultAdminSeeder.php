<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Carbon\Carbon;
//use Couchbase\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            'first_name'        => 'ADT',
            'last_name'         => 'Sports',
            'email'             => 'admin@adtsports.com',
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make('123456'),
        ];


        User::create($input);
    }
}
