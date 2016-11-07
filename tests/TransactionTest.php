<?php

use Budgeck\Models\Transaction;
use Budgeck\Models\TransactionType;

class TransactionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExpenseType()
    {
        $transaction = new Transaction();
        $transaction->transaction_type_id = strval(TransactionType::EXPENSE);

        $this->assertTrue($transaction->isExpense());
    }
}
