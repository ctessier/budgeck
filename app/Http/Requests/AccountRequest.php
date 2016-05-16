<?php

namespace Budgeck\Http\Requests;

use Budgeck\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class AccountRequest extends Request
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
            'name' => 'required|max:45',
            'description' => 'max:255',
            'account_type_id' => 'required|exists:account_types,id'
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
            'name.required' => 'Le nom ne peut pas être vide',
            'name.max' => 'Le nom ne peut pas être aussi long',
            'description.max' => 'La description ne peut pas être aussi longue',
            'account_type_id.required' => 'Le type de compte doit être sélectionné',
            'account_type_id.exists' => 'Le type de compte doit correspondre à un type existant'
        ];
    }
}
