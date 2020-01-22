<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use App\Models\Hospital;

trait TenantDb 
{
    /**
     * Set the tenant config
     *
     * @return void
     */
    public function __construct()
    {
        $hospital = Hospital::find(Auth::user()->hospital_id);
        
        $database =  strtolower($hospital->hospital_database);

        $username = Config::get('database.connections.mysql.username');
        $password = Config::get('database.connections.mysql.password');
        $host = Config::get('database.connections.mysql.host');
        
        $this->connectToDatabase($host, $username, $password, $database);
    }

    private function connectToDatabase($host, $username, $password, $database)
    {
        Config::set('database.connections.tenant.host', $host);
        Config::set('database.connections.tenant.username', $username);
        Config::set('database.connections.tenant.password', $password);
        Config::set('database.connections.tenant.database', $database);
        DB::purge('tenant');
        DB::reconnect('tenant');
        return true;

    }
}