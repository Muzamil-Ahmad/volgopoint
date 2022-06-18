<?php

use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
                DB::table('brand')->insert([
                    'name' => "samiullah",
                    'logo' => '	
                    073014-batman.jfif',
          
                    ]);
                    DB::table('brand')->insert([
                        'name' => "muzamil",
                        'logo' => '120122-batmanvssuperman.jfif',
              
                        ]);
        }
}
