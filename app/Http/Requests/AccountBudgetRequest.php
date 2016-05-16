<?php

namespace Budgeck\Http\Requests;

use Budgeck\Http\Requests\Request;

class AccountBudgetRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:45',
            'description' => 'max:255',
            'amount' => ['required', 'regex:"(^\d*\.?\d*[0-9]+\d*$)|(^[0-9]+\d*\.\d*$)"']
            //TODO: add validation for default category
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Le titre ne peut pas être vide',
            'title.max' => 'Le nom ne peut pas être aussi long',
            'description.max' => 'La description ne peut pas être aussi longue',
            'amount.required' => 'Le montant ne peut pas être vide',
            'amount.regex' => 'Le montant saisi est incorrect'
        ];
    }
}
