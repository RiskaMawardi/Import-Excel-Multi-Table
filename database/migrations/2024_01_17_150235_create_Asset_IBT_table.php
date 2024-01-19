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
            $table->foreign('InvoiceID')->references('id')->on('Invoice_IBT')->onDelete('cascade');
            $table->bigInteger('PODetailID');
            $table->foreign('PODetailID')->references('id')->on('PO_Detail_IBT')->onUpdate('cascade');
            $table->string('NomorInventaris',50)->nullable();
            $table->string('SerialNumber',50)->nullable();
            $table->string('MasterAssetSAP',50)->nullable();
            $table->string('PIC',2000)->nullable();
            $table->string('Divisi',50)->nullable();
            $table->string('Daerah',50)->nullable();
            $table->dateTime('AkhirGaransi')->nullable();
            $table->string('HardwareStatus',25)->nullable();
            $table->text('Note')->nullable();
            $table->text('RincianMaintenance')->nullable();
            $table->text('Keterangan')->nullable();
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
