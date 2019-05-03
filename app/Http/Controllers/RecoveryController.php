<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class RecoveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.recovery');
    }

    public function sendMail(Request $request)
    {
        $email = $request->email;
        $token = Str::random(30);
        $user = User::where('email', $email)->first();

        if(!empty($user))
        {
            $url = config("app.url").'/recovery/verify/'.$email.'/'.$token;
            
            //change the remember_token
            $user->remember_token = $token;
            $user->save();

            Mail::to($email)->send(new ResetPassword($url));
            return back()->with('status', 'Password reset email has been sent to '.$email);
        }else
        {
            return back()->with('status', 'The mail '.$email.' does not exist please register');
        }

        return $request;
    }

    public function verifyMail($email, $token)
    {
        $user = User::where('email', $email)->first();

        if(!empty($user))
        {
            if($user->remember_token == $token)
            {

                return view('auth.changePassword')->with('user', $user);

            }else{
                return redirect('/recovery')->with('status', 'Link has expired, please try again');
            }
        }
        else{
            return redirect('/register')->with('status', 'User does not exist');
        }
    }

    public function changePassword(Request $request, $id)
    {
        $this->validate($request, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->remember_token = '';
        $user->save();

        return redirect('/login')->with('status', 'Password has been changed.. Please Login');
        
    }
}
