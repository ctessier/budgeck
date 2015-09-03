<?php

namespace Budgeck\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Auth;

class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;
    
    protected $user;
    
    function __construct()
    {
        if (Auth::check())
        {
            $this->user = Auth::user();
            view()->share('user', $this->user);
        }
        else
        {
            $this->user = null;
        }
    }
}
