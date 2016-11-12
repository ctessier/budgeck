<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * @var Budgeck\Models\User
     */
    private $user;

    /**
     * Setup unit testing for User.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        // Create user
        $this->user = factory(Budgeck\Models\User::class)->create();

        // Create accounts for the user
        $account1 = factory(Budgeck\Models\Account::class)->create([
            'id'         => 1,
            'name'       => 'my_account',
            'is_default' => true,
            'user_id'    => $this->user->id,
        ]);
        $account2 = factory(Budgeck\Models\Account::class)->create([
            'id'         => 2,
            'is_default' => false,
            'user_id'    => $this->user->id,
        ]);

        // Add transactions to the accounts
        factory(Budgeck\Models\Transaction::class, 'expense')->create([
            'amount'     => 10.00,
            'value_date' => date('Y-m-d H:i:s'),
            'account_id' => $account1->id,
        ]);
        factory(Budgeck\Models\Transaction::class, 'expense')->create([
            'amount'     => 15.00,
            'value_date' => date('Y-m-d H:i:s'),
            'account_id' => $account1->id,
        ]);
        factory(Budgeck\Models\Transaction::class, 'expense')->create([
            'amount'     => 20.00,
            'value_date' => date('Y-m-d H:i:s'),
            'account_id' => $account2->id,
        ]);
        factory(Budgeck\Models\Transaction::class, 'expense')->create([
            'amount'     => 25.00,
            'value_date' => null,
            'account_id' => $account1->id,
        ]);
        factory(Budgeck\Models\Transaction::class, 'income')->create([
            'amount'     => 150.00,
            'value_date' => date('Y-m-d H:i:s'),
            'account_id' => $account2->id,
        ]);
    }

    /**
     * Test user default account.
     *
     * @return void
     */
    public function testDefaultAccount()
    {
        $this->assertEquals(1, $this->user->defaultAccount()->id);
    }

    /**
     * Test user relationships (accounts).
     *
     * @return void
     */
    public function testUserRelationships()
    {
        $this->assertEquals(2, count($this->user->accounts));
    }

    /**
     * Test user accounts list.
     *
     * @return void
     */
    public function testUserAccountsList()
    {
        $userAccountsList = $this->user->getAccountsList();
        $this->assertEquals(2, count($userAccountsList));
        $this->assertContains('my_account', $userAccountsList);
    }

    /**
     * Test user total balance.
     *
     * @return void
     */
    public function testUserBalance()
    {
        $this->assertEquals(105, $this->user->getTotalBalance());
    }
}
