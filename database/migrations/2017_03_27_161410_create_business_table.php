<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('town_city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('county')->nullable();
            $table->string('country')->nullable();
            $table->decimal('latitude',10,6);
            $table->decimal('longitude',10,6);
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
        Schema::dropIfExists('businesses');
    }
}
