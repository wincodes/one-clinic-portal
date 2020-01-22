<?php

namespace App\Http\Controllers;

use App\Models\StaffDetails;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{

    public function createEmployee(Request $request)
    {
        try {

            $messages = [
                'birth_date.date_format' => 'Date must be in this format 2020-12-01',
            ];

            $validator = Validator::make($request->all(), [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'birth_date' => ['date_format:Y-m-d'],
                'department_id' => ['numeric'],
                'office' => ['string', 'max:45'],
                'phone_number' => ['string', 'max:80'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'role' => ['required', 'string', 'max:255'],
            ], $messages);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $fullname = $request['first_name'] . ' ' . $request['last_name'];

            $user = User::create([
                'name' => $fullname,
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'remember_token' => Str::random(30),
                'hospital_name' => Auth::user()->hospital_name,
                'hospital_id' => Auth::user()->hospital_id,
                'role' => $request['role'],
                'phone' => $request['phone_number'],
                'confirmed' => 1,
                'active' => 1,
                'online_status' => 0
            ]);

            $staffDetails =  new StaffDetails;
            $staffDetails->user_id = $user->id;
            $staffDetails->first_name = $request['first_name'];
            $staffDetails->last_name = $request['last_name'];
            $staffDetails->birth_date = $request['birth_date'];
            $staffDetails->department_id = $request['department_id'];
            $staffDetails->office = $request['office'];
            $staffDetails->phone_number = $request['phone_number'];
            $staffDetails->save();

            return response()->json(['user' => $user], 201);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function getEmployees()
    {
        $employees = StaffDetails::all();
        return response()->json(['employees' => $employees], 201);
    }

    public function updateEmployee(Request $request, $id)
    {
        try {
            $messages = [
                'birth_date.date_format' => 'Date must be in this format 2020-12-01',
            ];

            $validator = Validator::make($request->all(), [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'birth_date' => ['date_format:Y-m-d'],
                'office' => ['string', 'max:45'],
                'phone_number' => ['string', 'max:80'],
            ], $messages);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $staffDetails = StaffDetails::find($id);
            $staffDetails->first_name = $request->first_name;
            $staffDetails->last_name = $request->last_name;
            $staffDetails->office = $request->office;
            $staffDetails->phone_number = $request->phone_number;
            $staffDetails->save();

            return response()->json(['employees' => $staffDetails], 200);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function deleteEmployee($id){
        $staffDetails = StaffDetails::find($id);
        User::find($staffDetails->user_id)->delete();
        $staffDetails->delete();

        return response()->json('employee deleted successfully', 200);
    }
}
