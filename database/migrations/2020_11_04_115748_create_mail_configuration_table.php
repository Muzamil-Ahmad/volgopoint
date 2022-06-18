<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_configuration', function (Blueprint $table) {
            $table->id();
            $table->string('mail_address',500)->default(NULL)->collation = 'utf8_unicode_ci';
            $table->string('mail_encryption',500)->default(NULL)->collation = 'utf8_unicode_ci';
            $table->string('mail_host',500)->default(NULL)->collation = 'utf8_unicode_ci';
            $table->string('mail_from',500)->default(NULL)->collation = 'utf8_unicode_ci';
            $table->string('mailer_name',500)->default(NULL)->collation = 'utf8_unicode_ci';
            $table->string('mail_password',500)->default(NULL)->collation = 'utf8_unicode_ci';
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
        Schema::dropIfExists('mail_configuration');
    }
}
