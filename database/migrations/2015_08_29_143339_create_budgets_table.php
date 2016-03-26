<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_budgets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 45);
            $table->string('description', 255)->nullable();
            $table->float('amount')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->integer('default_category_id')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('default_category_id')->references('id')->on('categories')->onDelete('set null');
        });

        Schema::create('budgets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 45);
            $table->string('description', 255)->nullable();
            $table->float('amount')->unsigned();
            $table->integer('year')->length(4)->unsigned();
            $table->integer('month')->length(2)->unsigned();
            $table->integer('account_budget_id')->nullable()->unsigned();
            $table->integer('account_id')->unsigned();
            $table->integer('default_category_id')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('account_budget_id')->references('id')->on('account_budgets')->onDelete('set null');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('default_category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('budgets');
        Schema::drop('account_budgets');
    }
}
