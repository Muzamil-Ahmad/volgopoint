<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => "Luggages",
            'banner' => '085845-METRIC.jpg',
            'icon' => '090740-superman.jpg',
        ]);
        DB::table('categories')->insert([
            'name' => "Appliances",
            'banner' => '092945-Employee.jpg',
            'icon' => '113311-spiderman-hd-4k-superheroes-wallpaper-preview.jpg',
        ]);
     
    }
}
