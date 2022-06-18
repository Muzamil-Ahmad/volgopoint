<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('sitename', 50)->collation = 'utf8_unicode_ci';

            $table->string('address', 255)->collation = 'utf8_unicode_ci';
            $table->string('footertext', 50)->collation = 'utf8_unicode_ci';
            $table->string('email')->unique();
            $table->string('logo', 255)->collation = 'utf8_unicode_ci';
            $table->string('phone',20)->default(0);
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
}
