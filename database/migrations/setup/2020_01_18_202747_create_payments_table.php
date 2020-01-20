<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('recieved_by');
            $table->bigInteger('paid_by');
            $table->text('purpose');
            $table->bigInteger('bill_id')->nullable();
            $table->integer('total_billed');
            $table->integer('amount_paid');
            $table->integer('balance')->nullable();
            $table->enum('status', ['paid','part_paid', 'pending'])->default('pending');
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
        Schema::dropIfExists('payments');
    }
}
