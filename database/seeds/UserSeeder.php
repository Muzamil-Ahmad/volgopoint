<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "admin",
            'email' => 'admin@admin.com',
            'role_id' => 1,
            'password' => bcrypt('password'),
            ]);
        DB::table('users')->insert([
            'name' => "buyer",
            'email' => 'buyer@buyer.com',
            'role_id' => 2,
            'password' => bcrypt('password'),
            ]);
        DB::table('users')->insert([
            'name' => "Madiha",
            'email' => 'smadiha31@gmail.com',
            'role_id' => 1,
            'password' => bcrypt('password'),
            ]);
        DB::table('users')->insert([
            'name' => "Irfan",
            'email' => 'irfan@admin.com',
            'role_id' => 1,
            'password' => bcrypt('password'),
            ]);
    }
}
