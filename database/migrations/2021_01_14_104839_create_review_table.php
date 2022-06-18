<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review', function (Blueprint $table) {
            $table->id();
            $table->string('your_review', 1000)->collation = 'utf8_unicode_ci';
            $table->string('your_email', 100)->collation = 'utf8_unicode_ci';
            $table->string('your_name', 100)->collation = 'utf8_unicode_ci';
            $table->string('product_slug', 100)->collation = 'utf8_unicode_ci';
            $table->integer('review_stars')->default(0);
            $table->integer('product_id')->default(0);
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
        Schema::dropIfExists('review');
    }
}
