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
        Schema::create('transaction_types', function (Blueprint $table) {
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
            $table->date('value_date')->nullable();
            $table->text('comment')->nullable();
            $table->integer('transaction_type_id')->unsigned();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('account_id')->unsigned();
            $table->integer('budget_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('transaction_type_id')->references('id')->on('transaction_types')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('budget_id')->references('id')->on('budgets')->onDelete('set null');
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
    }
}
