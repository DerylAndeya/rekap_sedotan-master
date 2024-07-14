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
            'name' => 'Stanley',
            'role' => 'owner',
            'password' => Hash::make('plastikmusi2'),
            'email' => 'stanley@gmail.com',
        ]);

        DB::table('users')->insert([
            'name' => 'Siti',
            'role' => 'admin',
            'password' => Hash::make('admin1'),
            'email' => 'siti@gmail.com',
        ]);
    }
}
