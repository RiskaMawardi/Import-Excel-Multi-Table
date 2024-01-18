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
        Schema::create('assets_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('AssetID');
            $table->foreign('AssetID')->references('id')->on('assets')->onDelete('cascade');
            $table->string('HistoryDivisi')->nullable();
            $table->string('HistoryDaerah')->nullable();
            $table->string('HistoryPIC')->nullable();
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
        Schema::dropIfExists('assets_histories');
    }
};
