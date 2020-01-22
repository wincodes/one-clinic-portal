<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;


Route::get('/', 'HomeController@index');

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@mylogin');

Route::any('/logout', 'LogoutController@index');

Route::get('/recovery', 'RecoveryController@index');
Route::post('/recovery', 'RecoveryController@sendMail');
Route::get('/recovery/verify/{email}/{token}', 'RecoveryController@verifyMail');
Route::post('/recovery/change/{id}', 'RecoveryController@changePassword');

Route::get('/register', 'RegisterController@index');
Route::post('/register', 'RegisterController@create');
Route::get('/register/confirm/{email}/{token}', 'RegisterController@confirm');
Route::get('/register/resend', 'RegisterController@resend');
Route::post('/register/resend', 'RegisterController@verifyMail');


Route::group(['prefix' => 'dashboard'], function() {
    Route::get('/', 'DashboardController@index');
    Route::get('/all', 'DashboardController@dashboard');
});


Route::group(['prefix' => 'user'], function() {
    Route::get('/profile', 'UserController@index');
    Route::post('/profile/create', 'UserController@createProfile');
    Route::post('/profile/update', 'UserController@updateProfile');
});

Route::group(['prefix' => 'employee'], function() {
    Route::post('/create', 'EmployeeController@createEmployee')->middleware('admin');
    Route::get('/all', 'EmployeeController@getEmployees');
    Route::put('/{id}', 'EmployeeController@updateEmployee')->middleware('admin');
    Route::delete('/{id}', 'EmployeeController@deleteEmployee')->middleware('admin');
});

Route::get('/countries', 'CountryController@index');