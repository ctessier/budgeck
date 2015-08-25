<?php

namespace Budgeck\Http\Controllers;

use Auth;

class HomeController extends Controller
{
    public function home()
    {
        if (Auth::check())
        {
            return view('home');
        }
        else
        {
            return redirect('login');
        }
    }
}
