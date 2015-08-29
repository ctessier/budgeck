<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_incomes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 45);
            $table->string('description', 255)->nullable();
            $table->float('amount')->unsigned();
            $table->integer('day')->length(2)->unsigned();
            $table->integer('account_id')->unsigned();
            $table->integer('category_id')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->onDelete('cascade');
            
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('set null');
        });
        
        Schema::create('incomes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 45);
            $table->string('description', 255)->nullable();
            $table->float('amount')->unsigned();
            $table->integer('year')->length(4)->unsigned();
            $table->integer('month')->length(2)->unsigned();
            $table->date('expected_date')->nullable();
            $table->date('credit_date')->nullable();
            $table->integer('account_id')->unsigned();
            $table->integer('category_id')->nullable()->unsigned();
            $table->integer('account_income_id')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->onDelete('cascade');
            
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('set null');
            
            $table->foreign('account_income_id')
                ->references('id')
                ->on('account_incomes')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {        
        Schema::drop('incomes');
        Schema::drop('account_incomes');
    }
}
