<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factor', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('km_id');
			$table->unsignedBigInteger('motor_id');
			$table->year('year');
			$table->float('percentage')->nullable();
            $table->timestamps();
			$table->foreign('km_id')->references('id')->on('km')->onDelete('no action')->onUpdate('cascade');
			$table->foreign('motor_id')->references('id')->on('motor')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factor');
    }
}
