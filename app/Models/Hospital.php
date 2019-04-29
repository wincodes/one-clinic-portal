<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $connection = 'mysql';
    protected $table = 'hospitals';

    protected $fillable = ['user_id', 'hospital_name'];

    public function user()
    {
    	return $this->hasOne('App\User', 'id', 'user_id');
    }
}
