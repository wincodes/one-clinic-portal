<?php

namespace App\Listeners;

use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\RegistrationEvent;
use Illuminate\Support\Facades\DB;
use App\Models\Hospital;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class RegisterHospitalListener
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
        $initial_hospital_name = str_replace(' ', '_', $event->registered->hospital_name);
        $hospital_name = 'cp_' . $initial_hospital_name;

        //create a new hospital
        $createdHospital = Hospital::create([
            'user_id' => $event->registered->id,
            'hospital_database' => $hospital_name,
            'address' => $event->registered->hospital_address,
            'city' => $event->registered->city,
            'state' => $event->registered->state,
            'country_id' => $event->registered->country
        ]);

        $user = User::find($event->registered->id);
        $user->hospital_id = $createdHospital->id;
        $user->save();


        //create a  new MySQL Database for the user
        $this->createSchema($hospital_name);

        $database = $hospital_name;
        $username = Config::get('database.connections.mysql.username');
        $password = Config::get('database.connections.mysql.password');
        $host = Config::get('database.connections.mysql.host');
        $this->connectToDatabase($host, $username, $password, $database);
        $this->runSetupMigrations();
        $this->runPatchMigrations();
    }

    private function connectToDatabase($host, $username, $password, $database)
    {
        Config::set('database.connections.tenant.host', $host);
        Config::set('database.connections.tenant.username', $username);
        Config::set('database.connections.tenant.password', $password);
        Config::set('database.connections.tenant.database', $database);
    }

    function createSchema($schemaName)
    {
        return DB::statement('CREATE DATABASE ' . $schemaName);
    }

    private function runSetupMigrations()
    {

        Artisan::call('migrate', [
            '--database' => 'tenant',
            '--path' => 'database/migrations/setup',
            '--force' => true,
        ]);
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
