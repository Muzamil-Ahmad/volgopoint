<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->collation = 'utf8_unicode_ci';
            $table->string('added_by',50)->default('admin')->collation = 'utf8_unicode_ci';
            $table->integer('user_id')->default(0);
            $table->integer('rating_id')->default(0);
            $table->integer('category_id')->default(0);
            $table->integer('subcategory_id')->default(0);
            $table->integer('brand_id')->default(0);
            $table->integer('carousal_id')->default(0);
            $table->integer('tag_id')->default(0);
            $table->boolean('is_deleted')->default(0);
            $table->string('photos_tags',50)->nullable()->collation = 'utf8_unicode_ci';
            $table->string('thumbnail_img_tag',50)->nullable()->collation = 'utf8_unicode_ci';
            $table->string('photos', 2000)->collation = 'utf8_unicode_ci';
            $table->string('thumbnail_img', 100)->collation = 'utf8_unicode_ci';
            $table->string('featured_img', 100)->collation = 'utf8_unicode_ci';
            $table->string('attributes', 1000)->collation = 'utf8_unicode_ci';
            $table->string('flash_deal_img', 100)->collation = 'utf8_unicode_ci';
            $table->double('product_original_price', 8, 2)->default(0);
            $table->double('product_discount', 8, 2)->default(0);
            $table->double('product_discounted_price', 8, 2)->default(0);
            $table->integer('product_quantity')->default(0);
            $table->double('product_tax', 8, 2)->default(0);
            // $table->string('attributes', 1000)->collation = 'utf8_unicode_ci';
            $table->longText('product_description')->default(NULL);
            $table->longText('product_cart_description')->default(NULL);
            $table->longText('product_specification')->default(NULL);
            $table->mediumText('meta_title')->default(NULL);
            $table->string('slug', 100)->collation = 'utf8_unicode_ci';
            $table->longText('meta_description')->default(NULL);
            $table->longText('meta_keywords')->default(NULL);
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
        Schema::dropIfExists('products');
    }
}
