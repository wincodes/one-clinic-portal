<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Events\RegistrationEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('auth.register');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $data)
    {
        $this->validate($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'hospital_name' => ['required', 'string', 'max:50', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        $registered = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'remember_token' => Str::random(30),
            'hospital_name' => $data['hospital_name'],
            'confirmed' => 0,
            'active' => 0,
            'online_status' => 0
        ]);

        // return $registered;

        if(event( new RegistrationEvent($registered)))
        {
            return view('auth.regComplete')->with('registered', $registered);
        }else{
            return back()->with('status', 'Unable to complete Reistraton, Please try again');
        }
    }

    public function confirm($email, $token)
    {
        $user = User::where('email', $email)->first();

        if($user->confirmed == 1)
        {
            return redirect('/login')->with('status', 'your account is already verified, Please log in');
        }
        
        if ($user->remember_token == $token)
        {
            $user->confirmed = 1;
            $user->active = 1;
            $user->remember_token = '';
            $user->save();

            return redirect('/login')->with('status', 'your email account has been verified successfully, you can now log in');
        }else
        {
            return view('auth.tokenError')->with('email', $email);
        }
    }

    public function resend()
    {
        return view('auth.resendMail');
    }

    public function verifyMail(Request $request)
    {
        $email = $request->email;
        $token = Str::random(30);
        $data = User::where('email', $email)->first();

        if(!empty($data))
        {
            $url = config("app.url").'/register/confirm/'.$email.'/'.$token;
            
            //change the remember_token
            $data->remember_token = $token;
            $data->save();

            Mail::to($email)->send(new WelcomeMail($data, $url));
            return back()->with('status', 'Verification email has been sent to '.$email);
        }else
        {
            return back()->with('status', 'The mail '.$email.' does not exist please register');
        }
    }
}
