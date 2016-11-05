<?php

namespace Budgeck\Http\Requests;

class EditProfilePasswordRequest extends Request
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
                'oldpassword' => 'required',
                'newpassword' => 'required|confirmed',
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
                'oldpassword.required'  => 'Votre mot de passe actuel est requis',
                'newpassword.required'  => 'Le nouveau mot de passe ne peut pas être vide',
                'newpassword.confirmed' => 'Les mots de passe ne correspondent pas',
        ];
    }
}
