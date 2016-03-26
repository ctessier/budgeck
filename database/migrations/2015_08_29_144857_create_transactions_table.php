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

        Schema::create('transaction_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->timestamps();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 45);
            $table->float('amount')->unsigned();
            $table->date('transaction_date');
            $table->date('value_date')->nullable();
            $table->text('comment')->nullable();
            $table->integer('transaction_type_id')->unsigned();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('budget_id')->unsigned()->nullable();
            $table->integer('income_id')->unsigned()->nullable();
            $table->integer('payment_method_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('transaction_type_id')->references('id')->on('transaction_types')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('budget_id')->references('id')->on('budgets')->onDelete('set null');
            $table->foreign('income_id')->references('id')->on('incomes')->onDelete('set null');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('set null');
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
        Schema::drop('transaction_types');
        Schema::drop('payment_methods');
    }
}
