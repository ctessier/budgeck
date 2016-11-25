<?php

class AccountBudgetTest extends TestCase
{
    /**
     * @var Budgeck\Models\AccountBudget
     */
    private $account_budget;

    /**
     * Setup tests for AccountBudget model.
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

        // Add account budget
        $this->account_budget = factory(Budgeck\Models\AccountBudget::class)->create([
            'id'         => 4,
            'amount'     => 300,
            'account_id' => 1,
        ]);

        $this->account_budget->update([
            'amount' => 400,
        ]);
    }

    /**
     * Test Account relationship.
     *
     * @return void
     */
    public function testAccountRelationship()
    {
        $this->assertInstanceOf(Budgeck\Models\Account::class, $this->account_budget->account);
        $this->assertEquals(1, $this->account_budget->account->id);
    }

    /**
     * Test Budgets relationship.
     *
     * @return void
     */
    public function testBudgetsRelationship()
    {
        $this->account_budget->createMonthsBudget();

        $this->assertContainsOnlyInstancesOf(Budgeck\Models\Budget::class, $this->account_budget->budgets);
        $this->assertCount(config('budgeck.aheadness') + 1, $this->account_budget->budgets); // current month + aheadness
    }

    /**
     * Test budgets on account budget's update.
     *
     * @return void
     */
    public function testBudgetsAfterUpdate()
    {
        $this->account_budget->createMonthsBudget();

        $this->account_budget->update([
            'amount' => 100,
        ]);

        $this->assertCount(config('budgeck.aheadness') + 1, $this->account_budget->budgets); // current month + aheadness

        foreach ($this->account_budget->budgets() as $budget) {
            if ($budget->year !== date('Y') || $budget->month !== date('n')) {
                $this->assertEquals(100, $budget->amount);
            } else {
                $this->assertEquals(300, $budget->amount);
            }
        }
    }
}
