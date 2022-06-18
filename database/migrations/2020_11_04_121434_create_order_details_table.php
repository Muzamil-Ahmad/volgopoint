<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->UnsignedInteger('order_id');
            $table->UnsignedInteger('product_id');
            $table->double('price', 8, 2)->default(0);
            $table->double('actual_price', 8, 2)->default(0);
            $table->double('tax', 8, 2)->default(0);
            $table->double('discount', 8, 2)->default(0);
            $table->double('shipping_cost', 8, 2)->default(0);
            $table->UnsignedInteger('quantity')->default(1);
            $table->string('payment_status',20)->default("unpaid")->collation = 'utf8_unicode_ci';
            $table->string('delivery_status',20)->default("pending")->collation = 'utf8_unicode_ci';
            $table->string('shipping_type',255)->default("Home Delivery")->collation = 'utf8_unicode_ci';
            $table->string('product_referral_code',255)->default("0000")->collation = 'utf8_unicode_ci';
            $table->integer('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
