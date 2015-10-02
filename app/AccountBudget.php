<?php

namespace Budgeck;

use Carbon\Carbon;

class AccountBudget extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'amount', 'day', 'budget_type_id', 'category_id'];
    
    /**
     * Define the rules to create or edit an account budget
     * 
     * @var array 
     */
    protected $rules = [
        'title' => 'required|max:45',
        'description' => 'max:255',
        'amount' => ['required', 'regex:"(^\d*\.?\d*[0-9]+\d*$)|(^[0-9]+\d*\.\d*$)"'],
        'day' => 'required_if:budget_type_id,1|integer:2|min:1|max:31',
        'budget_type_id' => 'required|exists:budget_types,id',
        'category_id' => 'exists:categories,id'
    ];
    
    /**
     * Define the messages associated to the rules
     * 
     * @var array 
     */
    protected $messages = [
        'title.required' => 'Le titre ne peut pas être vide',
        'title.max' => 'Le nom ne peut pas être aussi long',
        'description.max' => 'La description ne peut pas être aussi longue',
        'amount.required' => 'Le montant ne peut pas être vide',
        'amount.regex' => 'Le montant saisi est incorrect',
        'day.digits_between' => 'Le jour saisi est incorrect',
        'day.required_if' => 'Le jour est requis pour une dépense unique',
        'day.integer' => 'Le jour doit être un nombre entier',
        'day.min' => 'Le jour doit être compris entre 1 et 31',
        'day.max' => 'Le jour doit être compris entre 1 et 31',
        'budget_type_id:required' => 'Un type de budget doit être sélectionné',
        'budget_type_id:exists' => 'Ce type de budget n\’existe pas',
        'category_id' => 'Cette catégorie n\'existe pas'        
    ];
    
    public function account()
    {
        return $this->belongsTo('Budgeck\Account');
    }
    
    /**
     * Create budgets from account budget according to defined aheadness
     */
    public function createMonthsBudget()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        
        for ($i=0 ; $i <= config('budgeck.aheadness') ; ++$i)
        {
            $budget = Budget::where('account_budget_id', $this->id)
                ->where('year', $currentYear)
                ->where('month', $currentMonth)
                ->withTrashed()
                ->get();
            
            if ($budget->isEmpty())
            {
                $budget = new Budget();
                $budget->title = $this->title;
                $budget->description = $this->description;
                $budget->amount = $this->amount;
                $budget->year = $currentYear;
                $budget->month = $currentMonth;
                $budget->date = ($this->day) ? Carbon::create($currentYear, $currentMonth, $this->day) : null;
                $budget->account_id = $this->account_id;
                $budget->category_id = $this->category_id;
                $budget->account_budget_id = $this->id;
                $budget->budget_type_id = $this->budget_type_id;
                $budget->save();
            }
            
            $currentMonth++;
            if ($currentMonth > 12)
            {
                $currentYear++;
                $currentMonth = 1;
            }
        }
    }
    
    /**
     * Update budgets from updated account income according to defined aheadness
     * Current month is not updated
     */
    public function updateMonthsBudget()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        
        for ($i=0 ; $i < config('budgeck.aheadness') ; ++$i)
        {
            $currentMonth++;
            if ($currentMonth > 12)
            {
                $currentYear++;
                $currentMonth = 1;
            }
            
            $budget = Budget::where('account_budget_id', $this->id)
                ->where('year', $currentYear)
                ->where('month', $currentMonth)
                ->first();
            
            if ($budget == null)
            {
                $budget = new Budget();
            }
            $budget->title = $this->title;
            $budget->description = $this->description;
            $budget->amount = $this->amount;
            $budget->year = $currentYear;
            $budget->month = $currentMonth;
            $budget->date = ($this->day) ? Carbon::create($currentYear, $currentMonth, $this->day) : null;
            $budget->account_id = $this->account_id;
            $budget->category_id = $this->category_id;
            $budget->account_budget_id = $this->id;
            $budget->budget_type_id = $this->budget_type_id;
            $budget->save();
        }
    }
}

AccountBudget::created(function($accountBudget){
    $accountBudget->createMonthsBudget();
});

AccountBudget::updated(function($accountBudget){
    $accountBudget->updateMonthsBudget();
});
