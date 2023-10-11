<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('market_launch_id');
			$table->float('km', 10, 2)->nullable();
			$table->float('import', 10, 2);
			$table->float('discount_factor', 10, 2)->nullable();
			$table->float('total', 10, 2);
			$table->boolean('is_cash');
            $table->timestamps();
			$table->foreign('market_launch_id')->references('id')->on('market_launch')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotation');
    }
}
