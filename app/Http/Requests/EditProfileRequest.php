<?php

namespace Budgeck\Http\Requests;

use Auth;
use Budgeck\Http\Requests\Request;

class EditProfileRequest extends Request
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
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100'
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
            'email.required' => 'L\'adresse e-mail ne peut pas être vide',
            'email.email' => 'L\'adresse e-mail semble incorrect',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée',
            'firstname.required' => 'Votre prénom ne peut pas être vide',
            'firstname.max' => 'Votre prénom ne peut pas être aussi long',
            'lastname.required' => 'Votre nom ne peut pas être vide',
            'lastname.max' => 'Votre nom ne peut pas être aussi long'
        ];
    }
}
