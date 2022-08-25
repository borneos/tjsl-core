<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->integer('id_category');
            $table->string('type');
            $table->longText('image');
            $table->longText('seo_image');
            $table->longText('additional_image');
            $table->longText('additional_image_seo');
            $table->string('name');
            $table->string('slug');
            $table->string('tagline');
            $table->longText('short_description');
            $table->longText('description');
            $table->longText('biography');
            $table->string('telp');
            $table->longText('address');
            $table->string('city');
            $table->string('district');
            $table->string('lat');
            $table->string('long');
            $table->string('owner_name');
            $table->string('owner_telp');
            $table->string('owner_email');
            $table->string('owner_address');
            $table->string('soc_fb')->nullable();
            $table->string('soc_ig')->nullable();
            $table->string('soc_twitter')->nullable();
            $table->string('website')->nullable();
            $table->string('link_borneos')->nullable();
            $table->string('link_tokopedia')->nullable();
            $table->string('link_shopee')->nullable();
            $table->string('link_bukalapak')->nullable();
            $table->tinyInteger('status')->default('1');
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
        Schema::dropIfExists('merchants');
    }
}
