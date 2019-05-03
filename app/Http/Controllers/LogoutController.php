<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        // Auth::logout();
        $user = auth()->user();    
        $user->last_active_time = now();
        $user->online_status = 0;
        $user->session_id = '';
        $user->save();
        Auth::logout();
        Auth::guard()->logout();
        session()->flush();

        return redirect('/');
    }

}
