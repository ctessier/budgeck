<?php

namespace Budgeck;

class Account extends BaseModel
{   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];
    
    /**
     * Define the rules to create or edit an account 
     * 
     * @var array 
     */
    protected $rules = [
        'name' => 'required|max:45',
        'description' => 'max:255'
    ];
    
    /**
     * Define the messages associated to the rules
     * 
     * @var array 
     */
    protected $messages = [
        'name.required' => 'Le nom ne peut pas être vide',
        'name.max' => 'Le nom ne peut pas être aussi long',
        'description' => 'La description ne peut pas être aussi longue'
    ];
    
    public function budgets()
    {
        return $this->hasMany('Budgeck\AccountBudget');
    }
    
    public function singleBudgets()
    {
        return $this->hasMany('Budgeck\AccountBudget')
            ->where('budget_type_id', BudgetType::SINGLE)
            ->orderby('day');
    }
    
    public function multipleBudgets()
    {
        return $this->hasMany('Budgeck\AccountBudget')
            ->where('budget_type_id', BudgetType::MULTIPLE)
            ->orderby('title');
    }
    
    public function incomes()
    {
        return $this->hasMany('Budgeck\AccountIncome')
            ->orderby('day');
    }
    
    public function getCurrentBalance()
    {
        return 'Indisponible';
    }
    
    /**
     * Return an account's budget from given id
     * 
     * @param int $id
     * @return Budgeck\AccountBudget
     */
    public function getBudgetById($id)
    {
        foreach ($this->budgets as $budget)
        {
            if ($budget->id == $id)
            {
                return $budget;
            }
        }
    }
    
    /**
     * Return an account's income from given id
     * 
     * @param int $id
     * @return Budgeck\AccountIncome
     */
    public function getIncomeById($id)
    {
        foreach ($this->incomes as $income)
        {
            if ($income->id == $id)
            {
                return $income;
            }
        }
    }
    
    /**
     * Return an account object from given id and logged in user
     * 
     * @param int $id
     * @return Budgeck\Account
     */
    public static function getUserAccountById($id)
    {
        return self::where('id', $id)
            ->where('user_id', \Auth::user()->id)
            ->first();
    }
}
