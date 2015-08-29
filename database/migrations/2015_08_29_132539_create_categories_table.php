<?php

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
        Schema::create('category_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->string('description', 255);
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->integer('category_type_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('category_type_id')
                ->references('id')
                ->on('category_types')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories');
        Schema::drop('category_types');
    }
}
