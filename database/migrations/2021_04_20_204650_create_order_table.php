<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('order_status_id');
			$table->unsignedBigInteger('customer_id');
			$table->unsignedBigInteger('cart_id');
			$table->decimal('import', 10, 2);
			$table->decimal('iva', 10, 2)->nullable();
			$table->decimal('total', 10, 2);
			$table->string('code', 255);
            $table->timestamps();
			$table->foreign('order_status_id')->references('id')->on('order_status')->onDelete('no action')->onUpdate('cascade');
			$table->foreign('customer_id')->references('id')->on('customer')->onDelete('no action')->onUpdate('cascade');
			$table->foreign('cart_id')->references('id')->on('cart')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
