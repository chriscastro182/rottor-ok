<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGasExrasProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table){
            $table->string('gas_cap', 155)->nullable()->after('bill_type');
            $table->text('extras')->nullable()->after('gas_cap');
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
            $table->dropColumn(['gas_cap', 'extras']);
        });
    }
}
