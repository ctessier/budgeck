<?php

class TransactionTest extends TestCase
{
    /**
     * @var Budgeck\Models\Transaction
     */
    private $transaction1;

    /**
     * @var Budgeck\Models\Transaction
     */
    private $transaction2;

    /**
     * Setup test for Transaction model.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        // Create an user
        $user = factory(Budgeck\Models\User::class)->create();

        // Create an account for the user
        factory(Budgeck\Models\Account::class)->create([
            'id'         => 1,
            'user_id'    => $user->id,
        ]);

        // Create budget
        factory(Budgeck\Models\Budget::class)->create([
            'id'         => 33,
            'amount'     => 300,
            'account_id' => 1,
        ]);

        // Create transactions
        $this->transaction1 = factory(Budgeck\Models\Transaction::class, 'expense')->create([
            'id'         => 1,
            'amount'     => 10,
            'budget_id'  => 33,
            'account_id' => 1,
        ]);
        $this->transaction2 = factory(Budgeck\Models\Transaction::class, 'income')->create([
            'id'         => 2,
            'amount'     => 10,
            'account_id' => 1,
        ]);
    }

    /**
     * Test budget relationship.
     *
     * @return void
     */
    public function testBudgetRelationship()
    {
        $this->assertTrue($this->transaction1->budget instanceof Budgeck\Models\Budget);
        $this->assertEquals(33, $this->transaction1->budget->id);
    }

    /**
     * Test transaction type.
     *
     * @return void
     */
    public function testTransactionType()
    {
        $this->assertTrue($this->transaction1->isExpense());
        $this->assertFalse($this->transaction2->isExpense());
    }
}
