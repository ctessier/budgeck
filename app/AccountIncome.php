<?php

namespace Budgeck;

use Carbon\Carbon;

class AccountIncome extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'amount', 'day', 'category_id'];
    
    /**
     * Define the rules to create or edit an account income
     * 
     * @var array 
     */
    protected $rules = [
        'title' => 'required|max:45',
        'description' => 'max:255',
        'amount' => ['required', 'regex:"(^\d*\.?\d*[0-9]+\d*$)|(^[0-9]+\d*\.\d*$)"'],
        'day' => 'required_if:budget_type_id,1|integer:2|min:1|max:31',
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
        'category_id' => 'Cette catégorie n\'existe pas'        
    ];
    
    public function account()
    {
        return $this->belongsTo('Budgeck\Account');
    }
    
    /**
     * Create incomes from account income according to defined aheadness
     */
    public function createMonthsIncome()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        
        for ($i=0 ; $i <= config('budgeck.aheadness') ; ++$i)
        {
            $income = Income::where('account_income_id', $this->id)
                ->where('year', $currentYear)
                ->where('month', $currentMonth)
                ->withTrashed()
                ->get();
            
            if ($income->isEmpty())
            {
                $income = new Income();
                $income->title = $this->title;
                $income->description = $this->description;
                $income->amount = $this->amount;
                $income->year = $currentYear;
                $income->month = $currentMonth;
                $income->date = ($this->day) ? Carbon::create($currentYear, $currentMonth, $this->day) : null;
                $income->account_id = $this->account_id;
                $income->category_id = $this->category_id;
                $income->account_income_id = $this->id;
                $income->save();
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
     * Update incomes from updated account income according to defined aheadness
     * Current month is not updated
     */
    public function updateMonthsIncome()
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
            
            $income = Income::where('account_income_id', $this->id)
                ->where('year', $currentYear)
                ->where('month', $currentMonth)
                ->first();
            
            if ($income == null)
            {
                $income = new Income();
            }
            $income->title = $this->title;
            $income->description = $this->description;
            $income->amount = $this->amount;
            $income->year = $currentYear;
            $income->month = $currentMonth;
            $income->date = ($this->day) ? Carbon::create($currentYear, $currentMonth, $this->day) : null;
            $income->account_id = $this->account_id;
            $income->category_id = $this->category_id;
            $income->account_income_id = $this->id;
            $income->save();
        }
    }
}

AccountIncome::created(function($accountIncome){
    $accountIncome->createMonthsIncome();
});

AccountIncome::updated(function($accountIncome){
    $accountIncome->updateMonthsIncome();
});
