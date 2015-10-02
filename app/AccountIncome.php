<?php

namespace Budgeck;

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
}
