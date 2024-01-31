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
            $table->foreign('JenisID')->references('id')->on('Jenis_IBT');
            $table->bigInteger('SupplierID')->nullable();
            $table->foreign('SupplierID')->references('id')->on('Supplier_IBT');
            $table->string('ProductCode',20);
            $table->string('ModelSpec',3000);
		    $table->decimal('Price', $precision = 21, $scale = 2)->nullable();
		    $table->string('UpdatedBy',100)->nullable();
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
        Schema::dropIfExists('products');
    }
};
