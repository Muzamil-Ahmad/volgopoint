<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->UnsignedInteger('user_id')->default(0);
            $table->longText('shipping_address')->default(NULL)->collation = 'utf8_unicode_ci';
            $table->string('delivery_time',100)->default('anytime')->Nullable();
            $table->string('payment_type',20)->default('cash on delivery')->collation = 'utf8_unicode_ci';
            $table->string('payment_status',20)->default('pending')->collation = 'utf8_unicode_ci';
            $table->longText('payment_details')->nullable()->collation = 'utf8_unicode_ci';
            $table->double('grand_total', 8, 2)->default(0);
            $table->mediumText('code')->nullable()->collation = 'utf8_unicode_ci';
            $table->integer('shipping_cost')->default(0)->collation = 'utf8_unicode_ci';
            $table->integer('is_deleted')->default(0);
            $table->integer('viewed')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
