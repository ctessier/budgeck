<?php

class BudgetTest extends TestCase
{
    /**
     * Setup unit testing for Account.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $user = factory(Budgeck\Models\User::class)->create();

        // Create accounts for the user
        factory(Budgeck\Models\Account::class)->create([
            'id'         => 1,
            'user_id'    => $user->id,
        ]);

        // Add budgets
        factory(Budgeck\Models\Budget::class)->create([
            'id'         => 1,
            'amount'     => 150,
            'year'       => '2016',
            'month'      => '11',
            'account_id' => 1,
        ]);
        factory(Budgeck\Models\Budget::class)->create([
            'id'         => 2,
            'amount'     => 200,
            'year'       => '2016',
            'month'      => '12',
            'account_id' => 1,
        ]);

        // Add transactions
        factory(Budgeck\Models\Transaction::class, 'expense')->create([
            'title'            => 'first_transaction',
            'amount'           => 20.00,
            'transaction_date' => '2016-01-01 00:00:00',
            'value_date'       => date('Y-m-d H:i:s'),
            'account_id'       => 1,
            'budget_id'        => 1,
        ]);
        factory(Budgeck\Models\Transaction::class, 'expense')->create([
            'amount'     => 25.00,
            'value_date' => date('Y-m-d H:i:s'),
            'account_id' => 1,
            'budget_id'  => 2,
        ]);
        factory(Budgeck\Models\Transaction::class, 'expense')->create([
            'title'            => 'second_transaction',
            'amount'           => 25.00,
            'transaction_date' => '2016-01-02 00:00:00',
            'value_date'       => date('Y-m-d H:i:s'),
            'account_id'       => 1,
            'budget_id'        => 1,
        ]);
        factory(Budgeck\Models\Transaction::class, 'expense')->create([
            'title'            => 'third_transaction',
            'amount'           => 25.00,
            'transaction_date' => '2016-01-03 00:00:00',
            'value_date'       => null,
            'account_id'       => 1,
            'budget_id'        => 1,
        ]);
        factory(Budgeck\Models\Transaction::class, 'income')->create([
            'amount'     => 25.00,
            'value_date' => null,
            'account_id' => 1,
            'budget_id'  => 1,
        ]);
    }

    /**
     * Test account relationship.
     *
     * @return void
     */
    public function testAccountRelationship()
    {
        $budget = Budgeck\Models\Budget::findOrFail(1);
        $this->assertEquals(1, $budget->account->id);
    }

    /**
     * Test transactions relationship.
     *
     * @return void
     */
    public function testTransactionSRelationship()
    {
        $budget = Budgeck\Models\Budget::findOrFail(1);
        $this->assertEquals(3, $budget->transactions->count());

        foreach ($budget->transactions as $transaction) {
            $this->assertEquals(Budgeck\Models\TransactionType::EXPENSE, $transaction->transaction_type_id);
        }
    }

    /**
     * Test amount spent.
     *
     * @return void
     */
    public function testAmountSpend()
    {
        $budget = Budgeck\Models\Budget::findOrFail(1);
        $this->assertEquals(70, $budget->getAmountSpent());
        $this->assertEquals(25, $budget->getAmountSpent(Budgeck\Models\Transaction::AWAITING));
        $this->assertEquals(45, $budget->getAmountSpent(Budgeck\Models\Transaction::EFFECTIVE));
        $this->assertEquals(70, $budget->getAmountSpent(6));

        $budget = Budgeck\Models\Budget::findOrFail(2);
        $this->assertEquals(25, $budget->getAmountSpent());
        $this->assertEquals(0, $budget->getAmountSpent(Budgeck\Models\Transaction::AWAITING));
        $this->assertEquals(25, $budget->getAmountSpent(Budgeck\Models\Transaction::EFFECTIVE));
        $this->assertEquals(25, $budget->getAmountSpent(6));
    }

    /**
     * Test amount remaining.
     *
     * @return void
     */
    public function testAmountRemaining()
    {
        $budget = Budgeck\Models\Budget::findOrFail(1);
        $this->assertEquals(80, $budget->getAmountRemaining());

        $budget = Budgeck\Models\Budget::findOrFail(2);
        $this->assertEquals(175, $budget->getAmountRemaining());
    }

    /**
     * Test order of transactions.
     *
     * @return void
     */
    public function testTransactionsOrder()
    {
        $budget = Budgeck\Models\Budget::findOrFail(1);

        $this->assertEquals(3, $budget->transactions->count());
        $this->assertEquals('third_transaction', $budget->transactions[0]->title);
        $this->assertEquals('second_transaction', $budget->transactions[1]->title);
        $this->assertEquals('first_transaction', $budget->transactions[2]->title);
    }
}
