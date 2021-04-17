<?php

use Illuminate\Database\Seeder;
use App\Setting;
class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	 $setting = Setting::create([
            'onsale' => NULL,
            'system_name' => 'E-Commerse System',
            'system_description' => 'No Description',
            'system_phone' => '+639 123456789',
            'system_email' => 'admin@admin.com',
            'system_address' => 'Isabela, Philippines',
            'system_location' => 'Isabela, Philippines'
        ]);
    }
}
