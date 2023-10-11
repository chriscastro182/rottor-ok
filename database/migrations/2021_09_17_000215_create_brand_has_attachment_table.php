<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandHasAttachmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_has_attachment', function (Blueprint $table) {
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('attachment_id');
            $table->foreign('brand_id')->references('id')->on('brand')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('attachment_id')->references('id')->on('attachment')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brand_has_attachment');
    }
}
