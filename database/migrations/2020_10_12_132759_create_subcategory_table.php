<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcategoryTable  extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->collation = 'utf8_unicode_ci';
            $table->integer('category_id')->default(NULL);
            $table->string('banner',500)->default(NULL)->collation = 'utf8_unicode_ci';
            $table->string('icon',500)->default(NULL)->collation = 'utf8_unicode_ci';
            $table->string('alt_tag',100)->default(NULL)->collation = 'utf8_unicode_ci';
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
        Schema::dropIfExists('subcategories');
    }
}
