<?php

namespace Budgeck\Models;

class RecurrentTransaction extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'amount', 'day', 'category_id'];

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
}
