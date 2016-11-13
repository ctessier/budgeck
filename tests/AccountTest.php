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
