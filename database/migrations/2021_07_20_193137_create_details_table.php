<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('order_id');
			$table->unsignedBigInteger('product_id');
			$table->unsignedBigInteger('attribute_id');
			$table->integer('quantity');
			$table->decimal('price', 10, 2);
			$table->decimal('tax', 10, 2)->nullable();
            $table->timestamps();
			$table->foreign('order_id')->references('id')->on('order')->onDelete('no action')->onUpdate('cascade');
			$table->foreign('product_id')->references('id')->on('product')->onDelete('no action')->onUpdate('cascade');
			$table->foreign('attribute_id')->references('id')->on('attribute')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('details');
    }
}
