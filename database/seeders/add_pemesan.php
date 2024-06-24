<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class add_pemesan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pemesan')->insert([
            'nama_pemesan' => 'Akiong',
            'alamat' => 'Jl. Tulung Agung',
            'no_telp' => '0896644444',
            'kota' => 'Palembang',
        ]);
        //
    }
}
