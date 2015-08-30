<?php

namespace Budgeck\Http\Controllers;

class ProfileController extends Controller
{
    public function index()
    {
        $accounts = $this->user->accounts;
        
        view()->share('accounts', $accounts);
        return view('profile.index');
    }
    
    public function profileSave()
    {
        
    }
    
    public function passwordSave()
    {
        
    }
}
