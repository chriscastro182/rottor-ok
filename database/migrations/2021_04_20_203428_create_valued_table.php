<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValuedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valued', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('customer_id');
			$table->unsignedBigInteger('product_id');
			$table->decimal('import', 10, 2);
			$table->decimal('iva', 10, 2)->nullable();
			$table->decimal('total', 10, 2);
			$table->string('code', 255);
			$table->text('valued_data');
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
        Schema::dropIfExists('valued');
    }
}
