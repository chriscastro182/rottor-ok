<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('cart_status_id');
			$table->char('ip', 25)->nullable();
			$table->decimal('import', 10, 2)->nullable();
			$table->decimal('iva', 10, 2)->nullable();
			$table->decimal('total', 10, 2)->nullable();
			$table->string('user_agent', 255)->nullable();
            $table->timestamps();
			$table->foreign('cart_status_id')->references('id')->on('cart_status')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart');
    }
}
