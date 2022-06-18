<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->collation = 'utf8_unicode_ci';
            $table->string('slug', 50)->collation = 'utf8_unicode_ci';
            $table->string('logo',1000)->default(NULL)->collation = 'utf8_unicode_ci';
            $table->string('alt_tag',100)->default(NULL)->collation = 'utf8_unicode_ci';
            $table->integer('is_deleted')->default(0);
            $table->timestamps();//is_deleted
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brand');
    }
}
