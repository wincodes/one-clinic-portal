<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\Hospital;
use App\Models\Country;

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
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('user.profile.index')->with('profile', $profile);
    }

    public function editProfile()
    {
        $country = Country::all();
        return view('user.profile.edit-profile')->with('countries', $country);
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['string', 'max:7'],
            'address' => ['string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
            'city' => ['required', 'string', 'max:20'],
            'state' => ['required', 'string', 'max:20'],
            'country_id' => ['required', 'integer'],
            'position' => ['string', 'max:255'],
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable|max:1024'
        ]);

        if($request->hasFile('picture'))
        {
            $file = $request->file('picture')->getClientOriginalName();
            $fileName = time().'_'.$file;
            
            $path = $request->file('picture')->storeAs('public/images', $fileName);
        }

        $hospital_id = Hospital::where('user_id', Auth::id())->first();

        $profile = new Profile;

        $profile->user_id = Auth::id();
        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;
        $profile->gender = $request->gender;
        $profile->address = $request->address;
        $profile->city = $request->city;
        $profile->state = $request->state;
        $profile->country_id = $request->country_id;
        $profile->phone_number = $request->phone_number;
        $profile->hospital_id = $hospital_id->id;
        $profile->position = $request->position;

        if(!empty($fileName)){
            $profile->picture = $fileName;
        }
        
        if($profile->save())
        {
            return redirect('/user/profile')->with('status', 'Profile Updated');
        }else{
            return  'An error Occurred Please try again';
        }

    }
}
