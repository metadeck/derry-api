<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->integer('parent_id')->nullable()->unsigned();            
            $table->timestamps();
        });

        Schema::create('business_category', function (Blueprint $table) {
            $table->integer('business_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->primary(['business_id', 'category_id'], 'business_category_primary_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('business_category');
    }
}
