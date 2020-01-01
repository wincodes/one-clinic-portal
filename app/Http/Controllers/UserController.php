<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\Hospital;
use App\Models\Country;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

        return response()->json([
            'profile' => $profile
        ], 200);
    }

    public function createProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['nullable', 'string', 'max:7'],
            'address' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
            'city' => ['required', 'string', 'max:20'],
            'state' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string'],
            'position' => ['required', 'string', 'max:255'],
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }


        if ($request->hasFile('picture')) {
            $file = $request->file('picture')->getClientOriginalName();
            $fileName = time() . '_' . $file;

            $request->file('picture')->storeAs('public/images/uploads', $fileName);
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
        $profile->country = $request->country;
        $profile->phone_number = $request->phone_number;
        $profile->hospital_id = $hospital_id->id;
        $profile->position = $request->position;

        $profile->save();

        if (!empty($fileName)) {
            $profile->picture = $fileName;
        }

        return response()->json(['profile' => $profile], 201);
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['nullable', 'string', 'max:7'],
            'address' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
            'city' => ['required', 'string', 'max:20'],
            'state' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string'],
            'position' => ['required', 'string', 'max:255'],
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }


        $profile = Profile::where('user_id', Auth::id())->first();

        $update = $request->all();

        if ($request->hasFile('picture')) {
            Storage::delete('public/images/' . $profile->picture);

            $file = $request->file('picture')->getClientOriginalName();
            $fileName = time() . '_' . $file;

            $request->file('picture')->storeAs('public/images/uploads', $fileName);

            $update['picture'] = $fileName;
        }


        $profile->update($update);

        return response()->json(['Updated Sucessfully'], 200);
    }
}
