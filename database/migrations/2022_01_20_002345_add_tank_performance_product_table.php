<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTankPerformanceProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table){
            $table->string('tank_capacity', 255)->nullable()->after('bill_type');
            $table->string('performance', 255)->after('tank_capacity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product', function (Blueprint $table){
            $table->dropColumn(['tank_capacity', 'performance']);
        });
    }
}
