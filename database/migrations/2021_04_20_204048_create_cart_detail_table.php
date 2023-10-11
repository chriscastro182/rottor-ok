<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_detail', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('cart_id');
			$table->unsignedBigInteger('product_id');
			$table->unsignedBigInteger('attribute_id');
            $table->timestamps();
			$table->foreign('cart_id')->references('id')->on('cart')->onDelete('no action')->onUpdate('cascade');
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
        Schema::dropIfExists('cart_detail');
    }
}
