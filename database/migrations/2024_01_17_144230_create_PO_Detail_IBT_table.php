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
            $table->foreign('POHeaderID')->references('id')->on('PO_Header_IBT');
            $table->bigInteger('ProductID')->nullable();
            $table->foreign('ProductID')->references('id')->on('Product_IBT');
            $table->decimal('Price', $precision = 21, $scale = 2)->nullable();
            $table->integer('Qty')->nullable();
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
        Schema::dropIfExists('PO_Details');
    }
};
