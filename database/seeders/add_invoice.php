<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class add_invoice extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('invoice')->insert([
            'tanggal_transaksi' => '',
            'metoder_pembayaran' => '',
            'status_pemesanan' => '',
            'FK_kendaraan' => '1',
            'FK_pemesan' => '1',
            'FK_pegawai' => '1',
        ]);
        //
    }
}
