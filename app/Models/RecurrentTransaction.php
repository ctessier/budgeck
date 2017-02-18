<?php

namespace Budgeck\Models;

class RecurrentTransaction extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'amount', 'day', 'transaction_type_id', 'category_id', 'account_budget_id'];

    /**
     * Return the account which the recurrent transaction belongs to.
     *
     * @return Account
     */
    public function account()
    {
        return $this->belongsTo($this->getBaseNamespace().'\Account');
    }

    /**
     * Return the account budget which the recurrent transaction belongs to.
     *
     * @return AccountBudget
     */
    public function account_budget()
    {
        return $this->belongsTo($this->getBaseNamespace().'\AccountBudget');
    }

    /**
     * Return the collection of transactions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany($this->getBaseNamespace().'\Transaction');
    }
}
