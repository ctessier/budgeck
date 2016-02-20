<?php

namespace Budgeck;

use Auth;

class Income extends BaseModel
{   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'amount', 'year', 'month',
        'date', 'account_id', 'category_id', 'account_income_id'];
    
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
        'date' => 'date_format:Y-m-d',
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
    public function transactions() {
        return $this->hasMany('Budgeck\Transaction');
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
     * Return the list of incomes according to year and month
     */
    public static function getListFromYearMonth($year, $month) 
    {
        $collection = self::select('incomes.id', 'incomes.title')
            ->leftJoin('accounts', 'incomes.account_id', '=', 'accounts.id')
            ->where('accounts.user_id', Auth::user()->id)
            ->where('incomes.year', $year)
            ->where('incomes.month', $month)
            ->lists('incomes.title', 'incomes.id');
        
        $collection->prepend('-- Sélectionner --', 0);
        return $collection;
    }
    
    /**
     *
     */
    public function getLeftToGet() {
        $leftToGet = $this->getTransactionsAmount() - $this->getTransactionsAmountCredited();
        
        if ($this->getTransactionsAmount() > $this->amount) {
            return $leftToGet;
        } else {
            return $this->amount - $this->getTransactionsAmountCredited();
        }
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
            return $account ? $account->getIncomes($year, $month) : [];
        }
        else
        {
            $incomes = [];
            foreach (\Auth::user()->accounts as $account)
            {
                if (empty($incomes))
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
