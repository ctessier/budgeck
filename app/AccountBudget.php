<?php

namespace Budgeck;

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
        'amount' => '',
        'day' => 'integer:2',
        'budget_type_id' => '',
        'category_id' => ''
    ];
    
    /**
     * Define the messages associated to the rules
     * 
     * @var array 
     */
    protected $messages = [
        
    ];
}
