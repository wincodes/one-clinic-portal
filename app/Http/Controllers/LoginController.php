<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Events\OnLogin;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    // protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function mylogin(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'string', 'email'],
            'password' => ['required'],
        ]);
        
        $email = $request->email;
        $userPassword = $request->password;
        $token = Str::random(30);

        $user = User::where('email', $email)->first();
        if(!empty($user))
        {
            //verify the password
            if (Hash::check($userPassword, $user->password)) {
                // The passwords match, check if the user mail has been verified
                if($user->confirmed == 0)
                {
                    return back()->with('status', 'Your email has not been verified, please check your mail for link
                    <br>
                    or request for a new link <a href="/register/resend"> click here  </a> 
                    ')->withInput();
                }
                else
                {
                    $user->online_status = 1;
                    $user->session_id = $token;
                    Auth::login($user);
                    Session::put('auth.token', $token);
    
                    event( new OnLogin($user));
                    
                    return redirect('/');
                }
            }else
            {
                //the password is incorrect
                $user = '';
                return back()->with('status', 'Incorrect Password')->withInput();
            }
        }else
        {
            //email not found
            return back()->with('status', 'Email Does not exist')->withInput();
        }
    }
}
