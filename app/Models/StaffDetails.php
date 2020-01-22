<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TenantDb;

class StaffDetails extends Model
{
    use TenantDb;

    protected $connection = 'tenant';
    protected $table = 'staff_details';

    protected $fillable = [
        'id', 'user_id', 'first_name', 'last_name', 'birth_date', 'department_id', 'office',
        'phone_number'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
