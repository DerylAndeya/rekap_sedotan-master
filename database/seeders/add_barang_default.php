<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class add_barang_default extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('barang')->insert([
            'nama_barang' => 'Pipet Pop Ice Ikan Layar',
            'harga' => '15000',
        ]);

        DB::table('barang')->insert([
            'nama_barang' => 'Pipet Kuda',
            'harga' => '13000',
        ]);
        //
    }
}
