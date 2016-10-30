<?php

namespace Budgeck\Http\Requests;

class BudgetRequest extends Request
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
            'title'               => 'required|max:45',
            'description'         => 'max:255',
            'amount'              => [
                'required',
                'regex:"^\d+\.?\d{0,2}$"',
                'not_in:0',
            ],
            'month'               => 'required|integer|min:1|max:12',
            'year'                => 'required|integer:4|min:2014',
            'default_category_id' => 'exists:categories,id',
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
            'title.required'  => 'Le titre ne peut pas être vide',
            'title.max'       => 'Le titre ne peut pas être aussi long',
            'description.max' => 'La description ne peut pas être aussi longue',
            'amount.required' => 'Le montant ne peut pas être vide',
            'amount.regex'    => 'Le format du montant est incorrect',
            'amount.not_in'   => 'Le montant ne peut pas être de 0,00 &euro;',
            'month.required'  => 'Un mois doit être sélectionné',
            'year.required'   => 'Une année doit être sélectionnée',
        ];
    }
}
