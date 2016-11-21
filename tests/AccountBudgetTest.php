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
            'account_id' => 1,
        ]);

        // Add account budget
        factory(Budgeck\Models\Budget::class)->create([
            'account_id'        => $this->account_budget->account_id,
            'account_budget_id' => $this->account_budget->id,
        ]);
        // Add account budget
        factory(Budgeck\Models\Budget::class)->create([
            'account_id'        => $this->account_budget->account_id,
            'account_budget_id' => $this->account_budget->id,
        ]);
        // Add account budget
        factory(Budgeck\Models\Budget::class)->create([
            'account_id'        => $this->account_budget->account_id,
            'account_budget_id' => $this->account_budget->id,
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
        $budgets = $this->account_budget->budgets;

        $this->assertContainsOnlyInstancesOf(Budgeck\Models\Budget::class, $budgets);
        $this->assertEquals(3, $budgets->count());
    }
}
