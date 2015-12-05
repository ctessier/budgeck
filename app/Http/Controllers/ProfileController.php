<?php

namespace Budgeck\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the application profile page
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.index');
    }
    
    private function getProfileValidator(array $data)
    {
        return \Validator::make($data,
            [
                'email' => 'required|email|unique:users,email,' . $this->user->id,
                'firstname' => 'max:100',
                'lastname' => 'max:100'
            ],
            [
                'email.required' => 'L\'adresse e-mail ne peut pas être vide',
                'email.email' => 'L\'adresse e-mail semble incorrect',
                'email.unique' => 'Cette adresse e-mail est déjà utilisée',
            ]
        );
    }
    
    private function getPasswordValidator(array $data)
    {
        return \Validator::make($data,
            [
                'oldpassword' => 'required',
                'newpassword' => 'required|confirmed',
            ],
            [
                'oldpassword.required' => 'Votre mot de passe actuel est requis',
                'newpassword.required' => 'Le nouveau mot de passe ne peut pas être vide',
                'newpassword.confirmed' => 'Les mots de passe ne correspondent pas',
            ]
        );
    }
    
    /**
     * Handles a profile save post request
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response json
     */
    public function postProfileSave(Request $request)
    {
        $v = $this->getProfileValidator($request->all());
        
        if ($v->fails())
        {
            return response()->json(['errors' => $v->errors()]);
        }
        
        $this->user->fill($request->all());
        if ($this->user->save())
        {
            return response()->json([
                'success' => 'Vos informations ont été mise à jour.'
            ]);
        }
        else
        {
            return response()->json([
                'errors' => ['form' => 'Une erreur s\'est produite.']
            ]);
        }
    }
    
    /**
     * Handles a password save post request
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response json
     */
    public function postPasswordSave(Request $request)
    {
        $v = $this->getPasswordValidator($request->all());
        
        if ($v->fails())
        {
            return response()->json(['errors' => $v->errors()]);
        }
        
        if (!Hash::check($request->get('oldpassword'), $this->user->password))
        {
            return response()->json([
                'errors' => ['form' => 'Le mot de passe actuel est incorrect.']
            ]);
        }
        
        $this->user->password = Hash::make($request->get('newpassword'));
        if ($this->user->save())
        {
            return response()->json([
                'success' => 'Votre mot de passe a été mise à jour.'
            ]);
        }
        else
        {
            return response()->json([
                'errors' => ['form' => 'Une erreur s\'est produite.']
            ]);
        }
    }
}
