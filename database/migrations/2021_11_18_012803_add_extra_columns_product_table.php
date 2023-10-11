<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraColumnsProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function(Blueprint $table){
            $table->string('owners', 155)->nullable()->after('year');
            $table->string('km', 155)->nullable()->after('owners');
            $table->string('bill_type', 155)->nullable()->after('km');
            $table->unsignedBigInteger('version_id')->nullable()->after('model_id');
            $table->foreign('version_id')->references('id')->on('version')->onDelete('no action')->onUpdate('cascade');
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
            $table->dropColumn(['owners', 'km', 'bill_type', 'version_id']);
        });
    }
}
