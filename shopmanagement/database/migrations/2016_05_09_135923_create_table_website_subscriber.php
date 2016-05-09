<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWebsiteSubscriber extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('subscriber', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_shop');
            $table->integer('category_id');
            $table->string('username',256);
            $table->integer('phone');
            $table->string('address',1000);
            $table->string('email',256);
            $table->string('password',256);
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
        //
        Schema::drop('subscriber');
    }
}
