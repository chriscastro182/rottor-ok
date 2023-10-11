<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentHasOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_has_order', function (Blueprint $table) {
			$table->unsignedBigInteger('appointment_id');
			$table->unsignedBigInteger('order_id');
			$table->foreign('appointment_id')->references('id')->on('appointment')->onDelete('no action')->onUpdate('cascade');
			$table->foreign('order_id')->references('id')->on('order')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment_has_order');
    }
}
