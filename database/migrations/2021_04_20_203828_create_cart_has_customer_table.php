<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartHasCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_has_customer', function (Blueprint $table) {
			$table->unsignedBigInteger('cart_id');
			$table->unsignedBigInteger('customer_id');
			$table->foreign('cart_id')->references('id')->on('cart')->onDelete('no action')->onUpdate('cascade');
			$table->foreign('customer_id')->references('id')->on('customer')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_has_customer');
    }
}
