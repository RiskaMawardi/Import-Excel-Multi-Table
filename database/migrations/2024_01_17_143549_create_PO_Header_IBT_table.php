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
        Schema::create('PO_Header_IBT', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('SupplierID');
            $table->foreign('SupplierID')->references('id')->on('Supplier_IBT');
            $table->string('PONumber',25)->nullable();
            $table->dateTime('PODate')->nullable();
            $table->integer('PPN')->nullable();
            $table->string('Note', 500)->nullable();
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
        Schema::dropIfExists('PO_Headers');
    }
};
