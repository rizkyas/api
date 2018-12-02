<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        if(Session::has('loginSession')){
          //  return view('admin/dashboard');           
        } else {
            return redirect('/login')->witherror('Please Login To Access');
        }
        return view('admin/dashboard');
    }

    public function settings()
    {
        return view('admin/settings');
    }

}
