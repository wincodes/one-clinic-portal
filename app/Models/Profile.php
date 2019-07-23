<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TenantDb;

class Profile extends Model
{
    use TenantDb;

    
    protected $connection = 'tenant';
    protected $table = 'profiles';

    protected $fillable = ['user_id', 'first_name', 'last_name', 'gender', 'address', 'city', 
        'state', 'country_id', 'phone_number', 'hospital_id', 'position', 'picture'];
}
