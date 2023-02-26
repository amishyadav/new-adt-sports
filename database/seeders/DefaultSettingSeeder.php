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
            'email'              => 'admin@adtsports.com',
            'copy_right_text'    => 'All Rights Reserved (C)',
            'logo'               => $logo,
            'favicon'            => $favicon,
            'cookie_description' => 'Your experience on this site will be improved by allowing cookies.',
            'cookie_is'          => 1,
            'policy_link'        => '',
            'currency'           => 1,
            'show_captcha'       => 0,
            'site_key'           => '',
            'secret_key'         => '',
        ];

        foreach ($settingData as $key => $value) {
            $settingDataExist = Setting::where('key', $key)->exists();
            if (!$settingDataExist) {
                Setting::create(['key' => $key, 'value' => $value]);
            }
        }
    }
}
