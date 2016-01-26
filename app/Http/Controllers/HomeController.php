<?php

namespace Budgeck\Http\Controllers;

class HomeController extends Controller {
    public function getHome()
    {
        if ($this->user)
        {
            return redirect(route('history', 'all'));
        }
        else
        {
            return redirect(route('login'));
        }
    }
}
