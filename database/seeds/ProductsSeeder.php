<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        DB::table('products')->insert([
            'name' => "Luggages",
            'category_id' => 1,
            'subcategory_id' => 1,
            'brand_id' => 1,
            'photos' => '["uploads/products/photos/0SiCxIRUgyZjyPIaEunqvQJapTKgkRLafukYOYkS.jpeg", "uploads\products\photos\0SiCxIRUgyZjyPIaEunqvQJapTKgkRLafukYOYkS.jpeg"]',
            'thumbnail_img' => 'uploads\products\thumbnail\2htwknieH4Fx8fxjsgksoS4nQeMFWGMo1pRMaTIi.jpeg',
            'featured_img' => '',
            'flash_deal_img' => '',
            'product_original_price' => 500,    
            'product_discounted_price' => 400,
            'product_discount' => 100,
            'product_quantity' => 23,
            'product_tax' => 0,
            'product_description' => "details around features, problems it solves and other benefits to help generate a sale.",
            'product_cart_description' => "A product description is the marketing copy used to describe a product's value proposition to potential customers. A compelling product description provides customers with details around features, problems it solves and other benefits to help generate a sale.",
            'meta_title' => "asdasd",
            'slug'=>rand(1,10),
            'meta_description' => 'dasdas',
            'meta_keywords' => 'dasdas',
        ]);
        DB::table('products')->insert([
            'name' => "Luggages",
            'category_id' => 1,
            'subcategory_id' => 1,
            'brand_id' => 1,
            'photos' => '["uploads\products\photos\47eBOXlPrReYR39WYY6kqKmYVkCLZxEZXDkFTMAS.jpeg","uploads\products\photos\47eBOXlPrReYR39WYY6kqKmYVkCLZxEZXDkFTMAS.jpeg"]',
            'thumbnail_img' => 'uploads\products\thumbnail\QleWnRmveHkmmKihetBZD9awcg7HiqrN1tfWHM1p.jpeg',
            'featured_img' => '',
            'flash_deal_img' => '',
            'product_original_price' => 1000,
            'product_discounted_price' => 800,
            'product_discount' => 200,
            'product_quantity' => 23,
            'product_tax' => 21,
            'product_description' => "details around features, problems it solves and other benefits to help generate a sale.",
            'product_cart_description' => "A product description is the marketing copy used to describe a product's value proposition to potential customers. A compelling product description provides customers with details around features, problems it solves and other benefits to help generate a sale.",
            'meta_title' => "asdasd",
            'slug'=>rand(1,10),
            'meta_description' => 'dasdas',
            'meta_keywords' => 'dasdas',
        ]);
      
    }
}
