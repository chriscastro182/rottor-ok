<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentHasQuotationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_has_quotation', function (Blueprint $table) {
			$table->unsignedBigInteger('appointment_id');
			$table->unsignedBigInteger('quotation_id');
			$table->foreign('appointment_id')->references('id')->on('appointment')->onDelete('no action')->onUpdate('cascade');
			$table->foreign('quotation_id')->references('id')->on('quotation')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment_has_quotation');
    }
}
