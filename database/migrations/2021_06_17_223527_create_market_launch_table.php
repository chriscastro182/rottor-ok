<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketLaunchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_launch', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('brand_id');
			$table->unsignedBigInteger('model_id');
			$table->year('year');
			$table->integer('cc');
			$table->boolean('is_cashiable');
			$table->float('full_payment', 10, 2)->nullable();
			$table->float('exchange_payment', 10, 2)->nullable();
			$table->float('allocation_payment', 10, 2)->nullable();
            $table->timestamps();
			$table->foreign('brand_id')->references('id')->on('brand')->onDelete('no action')->onUpdate('cascade');
			$table->foreign('model_id')->references('id')->on('model')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('market_launch');
    }
}
