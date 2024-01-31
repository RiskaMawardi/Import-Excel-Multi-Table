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
        Schema::create('Asset_IBT', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('InvoiceID');
            $table->foreign('InvoiceID')->references('id')->on('Invoice_IBT');
            $table->bigInteger('PODetailID');
            $table->foreign('PODetailID')->references('id')->on('PO_Detail_IBT');
            $table->string('NomorInventaris',50)->nullable();
            $table->string('SerialNumber',50)->nullable();
            $table->string('MasterAssetSAP',50)->nullable();
            $table->string('PIC',1000)->nullable();
            $table->string('Divisi',50)->nullable();
            $table->string('Daerah',50)->nullable();
            $table->dateTime('AkhirGaransi')->nullable();
            $table->string('HardwareStatus',25)->nullable();
            $table->string('Note', 1000)->nullable();
            $table->string('RincianMaintenance', 500)->nullable();
            $table->string('Keterangan', 500)->nullable();
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
        Schema::dropIfExists('assets');
    }
};
