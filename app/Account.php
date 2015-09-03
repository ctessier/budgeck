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
     *
     * @var type 
     */
    public $rules = [
        'name' => 'required'
    ];
    
    /**
     *
     * @var type 
     */
    public $messages = [
        'name.required' => 'Le nom ne peut pas être vide'
    ];
    
    public function budgets()
    {
        return $this->hasMany('Budgeck\AccountBudget');
    }
    
    public function singleBudgets()
    {
        return $this->hasMany('Budgeck\AccountBudget')
            ->where('budget_type_id', BudgetType::SINGLE);
    }
    
    public function multipleBudgets()
    {
        return $this->hasMany('Budgeck\AccountBudget')
            ->where('budget_type_id', BudgetType::MULTIPLE);
    }
    
    public function incomes()
    {
        return $this->hasMany('Budgeck\AccountIncome');
    }
    
    public function getCurrentBalance()
    {
        return 'Indisponible';
    }
}
