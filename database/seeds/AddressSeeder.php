<?php

use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('address')->insert([
            'name' => "admin",
            'address1'=> "nawakadal",
            'address2'=> "rangreth",
            'city'=> "srinagar",
            'state'=> "kashmir",
            'pincode'=> "12332",	
            'country'	=> "USA",
            'user_id'=> 2,
            ]);
        DB::table('address')->insert([
            'name' => "muzamil",
            'address1'=> "lalchowk",
            'address2'=> "rangreth",
            'city'=> "srinagar",
            'state'=> "kashmir",
            'pincode'=> "12332",	
            'country'	=> "USA",
            'user_id'=> 2,
            ]);
            DB::table('address')->insert([
                'name' => "madiha",
                'address1'=> "buchpora",
                'address2'=> "rangreth",
                'city'=> "srinagar",
                'state'=> "kashmir",
                'pincode'=> "12332",	
                'country'	=> "USA",
                'user_id'=> 3,
                ]);
    }
    }

