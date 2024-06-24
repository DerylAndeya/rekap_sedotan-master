<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Fikril',
            'role' => 'owner',
            'password' => Hash::make('plastikmusi4'),
            'email' => 'fikrilgaming@gmail.com',
        ]);

        DB::table('users')->insert([
            'name' => 'Triyana',
            'role' => 'admin',
            'password' => Hash::make('admin1'),
            'email' => 'triyana@gmail.com',
        ]);
    }
}
