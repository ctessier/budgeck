<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecurrentTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create recurrent transactions table
        Schema::create('recurrent_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 45);
            $table->float('amount')->unsigned();
            $table->integer('day')->length(2)->unsigned();
            $table->boolean('next_month')->default(false);
            $table->integer('transaction_type_id')->unsigned();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('account_id')->unsigned();
            $table->integer('account_budget_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('transaction_type_id')->references('id')->on('transaction_types')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('account_budget_id')->references('id')->on('budgets')->onDelete('set null');
        });

        // Add foreign key in transactions table
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedInteger('recurrent_transaction_id')->nullable()->after('budget_id');

            $table->foreign('recurrent_transaction_id')->references('id')->on('recurrent_transactions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign('transactions_recurrent_transaction_id_foreign');
            $table->dropColumn('recurrent_transaction_id');
        });
        Schema::drop('recurrent_transactions');
    }
}
