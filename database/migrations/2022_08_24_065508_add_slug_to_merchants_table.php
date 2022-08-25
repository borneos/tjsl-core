<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToMerchantsTable extends Migration
{
    public function up()
    {
        Schema::table('merchants', function (Blueprint $table) {
            $table->string('slug')->after('name');
        });
    }
    public function down()
    {
        Schema::table('merchants', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
