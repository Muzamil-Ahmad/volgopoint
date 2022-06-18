<?php

use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mail_configuration')->insert([
            'mail_address' => "admin@admin.com",
            'mail_encryption' =>'password',
            'mail_host' => 'admin',
            'mail_from' =>"company",
            'mailer_name' =>"junaid",
            'mail_password' =>'password',
            ]);   
    }
}
