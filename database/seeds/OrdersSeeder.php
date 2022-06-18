<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'shipping_address' => "tangmarg budgam",
            'delivery_time' => Carbon::create('2000', '01', '01'),
            'payment_type' => 'cod',
            'payment_status' => 'not avail',
            'shipping_cost' => '26', 
            'is_deleted' => '0',
            'grand_total' => '2400',
        ]); 
        DB::table('orders')->insert([
            'shipping_address' => "srinagar",
            'delivery_time' => Carbon::create('2000', '01', '01'),
            'payment_type' => 'credit card',
            'payment_status' => 'not avail',
            'shipping_cost' => '25', 
            'is_deleted' => '0',
            'grand_total' => '24002',
        ]); 
        DB::table('orders')->insert([
            'shipping_address' => "lal chowk",
            'delivery_time' => Carbon::create('2000', '01', '01'),
            'payment_type' => 'cod',
            'payment_status' => 'not avail',
            'shipping_cost' => '29', 
            'is_deleted' => '0',
            'grand_total' => '2402',
        ]); 
        DB::table('orders')->insert([
            'shipping_address' => "ladakh",
            'delivery_time' => Carbon::create('2000', '01', '01'),
            'payment_type' => 'cod',
            'payment_status' => 'not avail',
            'shipping_cost' => '226', 
            'is_deleted' => '0',
            'grand_total' => '2410',
        ]); 
        DB::table('orders')->insert([
            'shipping_address' => "budgam",
            'delivery_time' => Carbon::create('2000', '01', '01'),
            'payment_type' => 'cod',
            'payment_status' => 'not avail',
            'shipping_cost' => '263', 
            'is_deleted' => '0',
            'grand_total' => '3400',
        ]); 
        DB::table('orders')->insert([
            'shipping_address' => "baramulla",
            'delivery_time' => Carbon::create('2000', '01', '01'),
            'payment_type' => 'cod',
            'payment_status' => 'not avail',
            'shipping_cost' => '223', 
            'is_deleted' => '0',
            'grand_total' => '9400',
        ]); 
    }
}
