<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoriteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('customer_id');
			$table->unsignedBigInteger('product_id');
            $table->timestamps();
			$table->foreign('customer_id')->references('id')->on('customer')->onDelete('no action')->onUpdate('cascade');
			$table->foreign('product_id')->references('id')->on('product')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorite');
    }
}
