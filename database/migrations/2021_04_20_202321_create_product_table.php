<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('brand_id');
			$table->unsignedBigInteger('model_id');
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->year('year');
            $table->boolean('sold');
			$table->integer('priority');
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
        Schema::dropIfExists('product');
    }
}
