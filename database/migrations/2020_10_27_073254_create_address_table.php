<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('address1', 100);
            $table->string('address2', 100);
            $table->string('city', 100);
            $table->string('state', 100);
            $table->char('pincode',10);
            // $table->string('state');

            $table->string('country')->default("USA");
            $table->integer('user_id');
            $table->integer('is_active')->default(0);
            $table->integer('is_deleted')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
}
