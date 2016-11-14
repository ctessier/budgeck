<?php

class AccountTest extends TestCase
{
    /**
     * @var Budgeck\Models\User
     */
    private $user;

    /**
     * @var Budgeck\Models\Account
     */
    private $account;

    /**
     * Setup unit testing for Account.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->user = factory(Budgeck\Models\User::class)->create();

        // Create accounts for the user
        factory(Budgeck\Models\Account::class)->create([
            'id'         => 1,
            'name'       => 'my_account',
            'is_default' => true,
            'user_id'    => $this->user->id,
        ]);
        $this->account = factory(Budgeck\Models\Account::class)->create([
            'id'         => 2,
            'is_default' => false,
            'user_id'    => $this->user->id,
        ]);

        // Add transactions
        factory(Budgeck\Models\Transaction::class, 'expense')->create([
            'amount'     => 20.00,
            'value_date' => date('Y-m-d H:i:s'),
            'account_id' => $this->account->id,
        ]);
        factory(Budgeck\Models\Transaction::class, 'expense')->create([
            'amount'     => 25.00,
            'value_date' => null,
            'account_id' => $this->account->id,
        ]);
        factory(Budgeck\Models\Transaction::class, 'income')->create([
            'amount'     => 150.00,
            'value_date' => date('Y-m-d H:i:s'),
            'account_id' => $this->account->id,
        ]);

        // Add account budgets
        factory(Budgeck\Models\AccountBudget::class, 3)->create([
            'account_id' => $this->account->id,
        ]);

        // Add budgets
        factory(Budgeck\Models\Budget::class, 2)->create([
            'year'       => '2016',
            'month'      => '11',
            'account_id' => $this->account->id,
        ]);
        factory(Budgeck\Models\Budget::class)->create([
            'year'       => '2016',
            'month'      => '12',
            'account_id' => $this->account->id,
        ]);
    }

    /**
     * Test user relationship.
     *
     * @return void
     */
    public function testUserRelationship()
    {
        $this->assertEquals($this->user->id, $this->account->user->id);
    }

    /**
     * Test fetching transactions.
     *
     * @return void
     */
    public function testFetchingTransactions()
    {
        $awaiting = $this->account->getTransactions(Budgeck\Models\Transaction::AWAITING);
        $this->assertEquals(1, $awaiting->count());

        $effective = $this->account->getTransactions(Budgeck\Models\Transaction::EFFECTIVE);
        $this->assertEquals(2, $effective->count());
    }

    /**
     * Test account's balance.
     *
     * @return void
     */
    public function testBalance()
    {
        $this->assertEquals(130, $this->account->getBalance());
    }

    /**
     * Test account's relationship with account budgets.
     *
     * @return void
     */
    public function testAccountBudgetRelationship()
    {
        $this->assertEquals(3, $this->account->account_budgets->count());
    }

    /**
     * Test fetching accounts's budgets.
     *
     * @return void
     */
    public function testFetchingBudgets()
    {
        $budgets = $this->account->getBudgets(2016, 11);
        $this->assertEquals(2, $budgets->count());

        $budgets = $this->account->getBudgets(2016, 12);
        $this->assertEquals(1, $budgets->count());
    }

    /**
     * Test makeDefault method.
     *
     * @return void
     */
    public function testMakeDefault()
    {
        $this->assertEquals(1, $this->user->defaultAccount()->id);
        $this->account->makeDefault();
        $this->assertEquals(2, $this->user->defaultAccount()->id);
    }
}
