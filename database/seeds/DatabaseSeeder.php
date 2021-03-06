<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        // $this->call(CategoriesSeeder::class); 
        // $this->call(ProductsSeeder::class); 
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        // $this->call(OrdersSeeder::class);
        // $this->call(AddressSeeder::class);
        // $this->call(SettingsSeeder::class);
    }
  
}
