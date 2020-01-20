<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patient_id');
            $table->bigInteger('admitted_by');
            $table->bigInteger('ward_id')->nullable();
            $table->bigInteger('bed_id')->nullable();
            $table->date('date_admitted');
            $table->enum('status', ['indoor', 'outdoor'])->default('indoor'); // indoor or outdoor
            $table->date('date_discharged')->nullable();
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
        Schema::dropIfExists('admissions');
    }
}
