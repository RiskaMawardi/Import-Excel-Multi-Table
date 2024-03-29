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
        Schema::create('Supplier_IBT', function (Blueprint $table) {
            $table->id();
            $table->string('SupplierCode',20);
            $table->string('SupplierName',100);
            $table->string('SupplierAddress',255)->nullable();
            $table->string('NPWP',25)->nullable();
            $table->string('SupplierPIC',255)->nullable();
            $table->string('BankNumber',150)->nullable();
            $table->string('PhoneNumber',60)->nullable();
            $table->string('Website',100)->nullable();
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
        Schema::dropIfExists('suppliers');
    }
};
