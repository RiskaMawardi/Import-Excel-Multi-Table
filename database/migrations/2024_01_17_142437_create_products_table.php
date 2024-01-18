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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('JenisID');
            $table->foreign('JenisID')->references('id')->on('jenis')->onDelete('cascade');
            $table->bigInteger('SupplierID')->nullable();
            $table->foreign('SupplierID')->references('id')->on('suppliers')->onDelete('cascade');
            $table->string('ProductCode',20);
            $table->string('ModelSpec',3000);
            $table->bigInteger('Price');
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
        Schema::dropIfExists('products');
    }
};
