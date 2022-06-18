<?php

use Illuminate\Database\Seeder;

class SubcategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subcategories')->insert([
            'name' => "outdoor",
            'category_id' => '1',
            'banner' => '095227-superman.jpg',
            'icon' => '104545-employee-benefits.jpg',
        ]);
        DB::table('subcategories')->insert([
            'name' => "appliances",
            'category_id' => '2',
            'banner' => '113446-brooke-cagle-g1Kr4Ozfoac-unsplash.jpg',
            'icon' => '120035-METRIC.jpg',
        ]);
      
    }
}
