<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function Logout()
    {
        Auth::logout();

        return redirect()->route('Auth.Login');
    }
}
