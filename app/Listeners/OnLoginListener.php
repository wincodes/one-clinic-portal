<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Hospital;
use DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;

class OnLoginListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     //
    // }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $hospital = Hospital::where('user_id',  $event->user->id)->first();
        
        $database =  strtolower($hospital->hospital_name);

        $username = Config::get('database.connections.mysql.username');
        $password = Config::get('database.connections.mysql.password');
        $host = Config::get('database.connections.mysql.host');
        
        $this->connectToDatabase($host, $username, $password, $database);
        $this->runPatchMigrations();

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

    private function runPatchMigrations()
    {
           
        Artisan::call('migrate', [
            '--database' => 'tenant',
            '--path' => 'database/migrations/patch',
            '--force' => true,
        ]);
    }
}
