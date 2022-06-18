<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_transaksis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_transaksi')->nullable();
            $table->unsignedBigInteger('id_detail_transaksi');
            $table->string('subtotal')->nullable();
            $table->foreign('id_detail_transaksi')->references('id')->on('detail_transaksi_aksesoris')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('data_transaksis');
    }
}
