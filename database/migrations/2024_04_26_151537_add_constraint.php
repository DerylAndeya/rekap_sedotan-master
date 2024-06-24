<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::table('invoice', function (Blueprint $table) {
            // Add a foreign key constraint
            $table->foreign('FK_metode_pembayaran')->references('id')->on('metode_pembayaran');
            $table->foreign('FK_bank')->references('id')->on('bank');
            $table->foreign('FK_pemesan')->references('id')->on('pemesan');
            $table->foreign('FK_pegawai')->references('id')->on('users');
        });

        Schema::table('transaksi', function (Blueprint $table) {
            // Add a foreign key constraint
            $table->foreign('FK_kode_invoice')->references('id')->on('invoice');
            $table->foreign('FK_kode_barang')->references('id')->on('barang');
        });

        Schema::table('tanda_terima', function (Blueprint $table) {
            // Add a foreign key constraint
            $table->foreign('FK_kode_invoice')->references('id')->on('invoice');
            $table->foreign('FK_jenis_kendaraan')->references('id')->on('jenis_kendaraan');
            $table->foreign('FK_pegawai')->references('id')->on('pegawai');
            $table->foreign('FK_pengirim')->references('id')->on('pengirim');
            $table->foreign('FK_penerima')->references('id')->on('penerima');
        });
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('invoice', function (Blueprint $table) {
            $table->dropForeign(['FK_metode_pembayaran']);
            $table->dropForeign(['FK_bank']);
            $table->dropForeign(['FK_pegawai']);
            $table->dropForeign(['FK_pemesan']);
        });

        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropForeign(['FK_kode_invoice']);
            $table->dropForeign(['FK_kode_barang']);
        });

        Schema::table('tanda_terima', function (Blueprint $table) {
            $table->dropForeign(['FK_kode_invoice']);
            $table->dropForeign(['FK_jenis_kendaraan']);
            $table->dropForeign(['FK_pegawai']);
            $table->dropForeign(['FK_pengirim']);
            $table->dropForeign(['FK_penerima']);
        });
        //
    }
};
