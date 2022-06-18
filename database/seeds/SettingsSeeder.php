<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('general_settings')->insert([
            'sitename' => "brothercart site",
            'address' => 'new york, usa',
            'footertext' => 'copyright@2020',
            'email' => "admin@admin",
            'logo' => '095519-sithamshu-manoj-bik_lIl9Nco-unsplash.png',
            'phone' => '12132132',
        ]);
    }
}
