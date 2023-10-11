<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('payment_type_id');
			$table->unsignedBigInteger('payment_status_id');
			$table->unsignedBigInteger('order_id');
			$table->integer('months')->nullable();
			$table->decimal('amount', 10, 2);
			$table->string('authorization', 155)->nullable();
			$table->string('card_name', 255)->nullable();
			$table->char('card_numbers', 6)->nullable();
			$table->text('data')->nullable();
			$table->integer('quantity')->nullable();
            $table->timestamps();
			$table->foreign('payment_type_id')->references('id')->on('payment_type')->onDelete('no action')->onUpdate('cascade');
			$table->foreign('payment_status_id')->references('id')->on('payment_status')->onDelete('no action')->onUpdate('cascade');
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
        Schema::dropIfExists('payment');
    }
}
