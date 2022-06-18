<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            'user_role' => "admin",
            'is_deleted' => 0
            ]);
        DB::table('role')->insert([
            'user_role' => "buyer",
            'is_deleted' => 0
            ]);
            
    }
}
