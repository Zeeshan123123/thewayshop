<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'name' => 'theme-mode',
            'value' => 'light',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
