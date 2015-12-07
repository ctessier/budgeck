<?php

namespace Budgeck;

class Spending extends BaseModel
{ 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['description', 'amount', 'payment_date', 'comment', 'category_id',
        'budget_id', 'payment_method_id'];
    
    /**
     * Define the rules to create or edit a spending 
     * 
     * @var array 
     */
    protected $rules = [
        'description' => 'required|max:255',
        'amount' => ['required', 'regex:"(^\d*\.?\d*[0-9]+\d*$)|(^[0-9]+\d*\.\d*$)"'],
        'payment_date' => 'required|date_format:Y-m-d',
        'debit_date' => 'date_format:Y-m-d',
        'category_id' => 'required|exists:categories,id',
        'budget_id' => 'required|exists:budgets,id',
        'payment_method_id' => 'required|exists:budgets,id'
    ];
    
    /**
     * Define the messages associated to the rules
     * 
     * @var array 
     */
    protected $messages = [
        'description.required' => 'La description ne peut pas être vide',
        'description.max' => 'La description ne peut pas être aussi longue'
    ];
}
