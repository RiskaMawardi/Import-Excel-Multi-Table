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
        Schema::create('Product_IBT', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('JenisID');
            $table->foreign('JenisID')->references('id')->on('Jenis_IBT')->onDelete('cascade');
            $table->bigInteger('SupplierID')->nullable();
            $table->foreign('SupplierID')->references('id')->on('Supplier_IBT')->onDelete('cascade');
            $table->string('ProductCode',20);
            $table->string('ModelSpec',3000);
            $table->boolean('MarkForDelete')->default('false');
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
