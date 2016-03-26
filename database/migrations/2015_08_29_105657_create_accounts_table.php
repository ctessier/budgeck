<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->timestamps();
        });

        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->string('description', 255);
            $table->integer('account_type_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->boolean('is_default')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('account_type_id')->references('id')->on('account_types');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('accounts');
        Schema::drop('account_types');
    }
}
