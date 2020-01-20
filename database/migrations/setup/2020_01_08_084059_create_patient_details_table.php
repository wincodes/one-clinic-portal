<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('registration_date');
            $table->date('birth_date');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('other_names', 100)->nullable();
            $table->string('address', 45)->nullable();
            $table->string('city', 45)->nullable();
            $table->string('state', 45)->nullable();
            $table->string('phone_number', 80)->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->bigInteger('registered_by');
            $table->bigInteger('family_id')->nullable();
            $table->string('family_role', 45)->nullable();
            $table->string('picture', 100)->nullable();
            $table->enum('status', ['admitted', 'treatement', 'discharged'])->default('discharged'); //treatment, discharged, admitted
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_details');
    }
}
