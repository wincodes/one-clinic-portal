<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'role', 'hospital_name', 'hospital_id', 'confirmed', 'active', 'remember_token', 'online_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user()
    {
    	return $this->hasOne('App\Models\Hospital');
    }

    public function profile()
    {
    	return $this->hasOne('App\Models\Profile');
    }

    public function staffDetails()
    {
    	return $this->hasOne('App\Models\StaffDetails');
    }
}
