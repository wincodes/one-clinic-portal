<?php

namespace App\Http\Controllers;

use App\Models\StaffDetails;
use Illuminate\Http\Request;

class DashboardController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');

        return view('dashboard');
    }

    public function dashboard(){
        $staff = StaffDetails::where('id', '>', 0)->limit(5)->get();

        $dashboard = (object) [
            'staffs' => $staff
        ];

        return response()->json(['dashboard' => $dashboard], 200);
    }

    
}
