<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTableProductImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('product_images', function (Blueprint $table) {
            $table->boolean('is_favicon')->after('product_id');
            $table->string('src')->after('is_favicon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('product_images', function (Blueprint $table) {
            $table->dropColumn('is_favicon');
            $table->dropColumn('src');
        });
    }
}
