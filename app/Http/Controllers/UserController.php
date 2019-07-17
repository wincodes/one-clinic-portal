<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;

class UserController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $profile = Profile::where('user_id', Auth::id());
        dd($profile);
        return view('user.profile.index')->with('profile', $profile);
    }

    public function editProfile()
    {
        return view('user.profile.edit-profile');
    }
}
