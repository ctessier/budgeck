<?php

namespace Budgeck\Http\Requests;

class TransactionRequest extends Request
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
            'title'            => 'required|max:255',
            'amount'           => ['required', 'regex:"(^\d*\.?\d*[0-9]+\d*$)|(^[0-9]+\d*\.\d*$)"'],
            'transaction_date' => 'required|date_format:Y-m-d',
            'value_date'       => 'date_format:Y-m-d',
            'month'            => 'required|integer|min:1|max:12',
            'year'             => 'required|integer:4|min:2014',
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
            'title.required'               => 'Le titre ne peut pas être vide',
            'title.max'                    => 'Le titre ne peut pas être aussi long',
            'amount.required'              => 'Un montant doit être saisi',
            'amount.regex'                 => 'Le format du montant est incorrect',
            'transaction_date.required'    => 'Une date de transaction est nécessaire',
            'transaction_date.date_format' => 'Le format de la date de transaction est incorrect',
            'value_date.date_format'       => 'Le format de la date de valeur est incorrect',
            'month.required'               => 'Un mois doit être sélectionné',
            'year.required'                => 'Une année doit être sélectionnée',
        ];
    }
}
