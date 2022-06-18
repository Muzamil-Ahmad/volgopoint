<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarousalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carousal', function (Blueprint $table) {
            $table->id();
            $table->string('title',100)->default(Null)->Nullable();
            $table->string('text',100)->default(Null)->Nullable();
            $table->string('image',255)->default(NULL)->Nullable()->collation = 'utf8_unicode_ci';
            $table->string('alt_tag',100)->Nullable()->collation = 'utf8_unicode_ci';
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
        Schema::dropIfExists('carousal');
    }
}
