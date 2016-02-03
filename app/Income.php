<?php

namespace Budgeck;

class Income extends BaseModel
{   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'amount', 'year', 'month',
        'expected_date', 'account_id', 'category_id', 'account_income_id'];
    
    /**
     * Define the rules to create or edit a income 
     * 
     * @var array 
     */
    protected $rules = [
        'title' => 'required|max:45',
        'description' => 'max:255',
        'amount' => ['required', 'regex:"(^\d*\.?\d*[0-9]+\d*$)|(^[0-9]+\d*\.\d*$)"'],
        'year' => 'required|integer:4|min:2014',
        'month' => 'required|integer|min:1|max:12',
        'expected_date' => 'date_format:Y-m-d',
        'account_id' => 'required|exists:accounts,id',
        'category_id' => 'exists:categories,id'
    ];
    
    /**
     * Define the messages associated to the rules
     * 
     * @var array 
     */
    protected $messages = [
        
    ];
    
    /**
     * Return the account of the income
     */
    public function account()
    {
        return $this->belongsTo('Budgeck\Account');
    }
    
    /**
     * 
     */
    public function getTransactionsAmount()
    {
        return $this->hasMany('Budgeck\Transaction')
            ->sum('amount');
    }
    
    /**
     * 
     */
    public function getTransactionsAmountCredited()
    {
        return $this->hasMany('Budgeck\Transaction')
            ->whereNotNull('effective_date')
            ->sum('amount');
    }
    
    /**
     *
     */
    public static function getFromAccounts($accounts)
    {
        $incomes = collect();
        foreach ($accounts as $account)
        {
            $incomes = $incomes->merge(self::select('incomes.*')
                ->where('account_id', $account->id)
                ->get()
            );
        }
        return $incomes;
    }
    
    /**
     * Return incomes of a given month
     *
     * @param int $user_id
     * @param int $account_id
     * @param int $year
     * @param int $month
     * @return
     */
    public static function getUserMonthIncomesFromAccountId($account_id, $year, $month)
    {
        if ($account_id !== 'all')
        {
            $account = Account::getUserAccountById($account_id);
            return $account ? $account->getIncomes($year, $month) : null;
        }
        else
        {
            $incomes = null;
            foreach (\Auth::user()->accounts as $account)
            {
                if ($incomes === null)
                {
                    $incomes = $account->getIncomes($year, $month);
                }
                else 
                {
                    $incomes = $incomes->merge($account->getIncomes($year, $month));
                }
            }
            return $incomes;
        }
    }
}
