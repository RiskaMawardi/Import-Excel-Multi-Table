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
        Schema::create('Invoice_IBT', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('POHeaderID');
            $table->foreign('POHeaderID')->references('id')->on('PO_Header_IBT')->onDelete('cascade');
            $table->string('InvoiceNumber',25)->nullable();
            $table->dateTime('InvoiceDate')->nullable();
            $table->dateTime('TermOfPayment')->nullable();
            $table->string('DONumber')->nullable();
            $table->string('FakturPajak',50)->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
