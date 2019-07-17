<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $connection = 'tenant';
    protected $table = 'profiles';

    protected $fillable = ['user_id', 'first_name', 'last_name', 'gender', 'address', 'city', 
        'state', 'country_id', 'phone_number', 'hospital_id', 'position', 'picture'];
}
