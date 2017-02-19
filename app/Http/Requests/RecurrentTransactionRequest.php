<?php

namespace Budgeck\Http\Requests;

class RecurrentTransactionRequest extends Request
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
            'title'             => 'required|max:255',
            'amount'            => ['required', 'regex:"(^\d*\.?\d*[0-9]+\d*$)|(^[0-9]+\d*\.\d*$)"'],
            'day'               => 'required|integer|min:1|max:31',
            'account_budget_id' => 'exists:account_budgets,id',
            'category_id'       => 'exists:categories,id',
        ];
    }
}
