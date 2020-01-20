<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaitingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waiting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('staff_id'); //staff being waited for
            $table->bigInteger('patient_id');
            $table->timestamp('waiting_since'); // time the patient started waiting
            $table->enum('status', ['waiting', 'attended'])->default('waiting');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('waiting');
    }
}
