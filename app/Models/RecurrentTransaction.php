<?php

namespace Budgeck\Models;

/**
 * Class RecurrentTransaction
 *
 * @package Budgeck\Models
 */
class RecurrentTransaction extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'account_id',
    ];

    /**
     * Return the account which the recurrent transaction belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo($this->getBaseNamespace().'\Account');
    }

    /**
     * Return the account budget which the recurrent transaction belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account_budget()
    {
        return $this->belongsTo($this->getBaseNamespace().'\AccountBudget');
    }

    /**
     * Return the category which the recurrent transaction belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo($this->getBaseNamespace().'\Category');
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
