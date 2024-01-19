<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PO_Detail_IBT', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('POHeaderID');
            $table->foreign('POHeaderID')->references('id')->on('PO_Header_IBT')->onDelete('cascade');
            $table->bigInteger('ProductID')->nullable();
            $table->foreign('ProductID')->references('id')->on('Product_IBT')->onUpdate('cascade');
            $table->integer('Price')->nullable();
            $table->integer('Qty')->nullable();
            $table->string('Spesifikasi',1000)->nullable();
            $table->boolean('MarkForDelete')->default('false');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PO_Details');
    }
};
