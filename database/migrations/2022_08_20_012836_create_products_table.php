<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->bigInteger('merchant_id');
            $table->string('merchant_name');
            $table->text('tags')->nullable();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->bigInteger('price');
            $table->longText('image')->nullable();
            $table->longText('additional_image')->nullable();
            $table->integer('status');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
