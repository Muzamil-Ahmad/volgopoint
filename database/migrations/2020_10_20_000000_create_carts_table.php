<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            // $table->string('userName');
            $table->UnsignedInteger('userId');
            // $table->string('productName');
            $table->UnsignedInteger('productId');
            // $table->UnsignedInteger('quantity');
            // $table->float('productPrice');
            // $table->UnsignedInteger('productQuantity');
            // $table->float('productFinalPrice');
            // $table->json('productImages',100)->nullable();
            $table->integer('quantity')->default(1);
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
        Schema::dropIfExists('carts');
    }
}