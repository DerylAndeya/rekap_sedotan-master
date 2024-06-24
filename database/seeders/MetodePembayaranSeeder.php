<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodePembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('metode_pembayaran')->insert([
            'nama_metode' => 'Cash',
        ]);
        DB::table('metode_pembayaran')->insert([
            'nama_metode' => 'Tranfer',
        ]);
    }
}
