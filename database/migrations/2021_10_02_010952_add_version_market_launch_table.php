<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVersionMarketLaunchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('market_launch', function(Blueprint $table){
              $table->unsignedBigInteger('version_id')->after('model_id')->nullable();
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
        Schema::table('market_launch', function(Blueprint $table){
            $table->dropColumn('version_id');
        });
    }
}
