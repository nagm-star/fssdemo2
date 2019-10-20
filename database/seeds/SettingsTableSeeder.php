<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Setting::create([
            'site_name' => 'laravel blog',

            'address' => 'Sudan, khartoum',

            'contact_number' => '249 99183323',

            'contact_email' => 'info@laravel_blog.com'
        ]);
    }
}

