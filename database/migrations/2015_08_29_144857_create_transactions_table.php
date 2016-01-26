<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 45);
            $table->float('amount')->unsigned();
            $table->date('transaction_date');
            $table->date('effective_date')->nullable();
            $table->text('comment')->nullable();
            $table->integer('category_id')->nullable()->unsigned();
            $table->integer('budget_id')->unsigned()->nullable();
            $table->integer('income_id')->unsigned()->nullable();
            $table->integer('payment_method_id')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('set null');
            
            $table->foreign('budget_id')
                ->references('id')
                ->on('budgets')
                ->onDelete('cascade');
            
            $table->foreign('income_id')
                ->references('id')
                ->on('incomes')
                ->onDelete('cascade');
            
            $table->foreign('payment_method_id')
                ->references('id')
                ->on('payment_methods')
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
        Schema::drop('transactions');
        Schema::drop('payment_methods');
    }
}
