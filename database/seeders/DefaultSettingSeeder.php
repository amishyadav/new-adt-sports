<?php

namespace Database\Seeders;

use App\Models\SeoTool;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class DefaultSettingSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $logo = ('images/logo.png');
        $favicon = ('images/Infy-hms-logo.png');

        $settingData = [
            'app_name'           => 'ADT-Sports',
            'contact_no'         => '+91 9979269732',
            'email'              => 'contact@adtsports.in',
            'address'            => 'address',
            'logo'               => $logo,
            'favicon'            => $favicon,
        ];

        foreach ($settingData as $key => $value) {
            $settingDataExist = Setting::where('key', $key)->exists();
            if (!$settingDataExist) {
                Setting::create(['key' => $key, 'value' => $value]);
            }
        }
    }
}
