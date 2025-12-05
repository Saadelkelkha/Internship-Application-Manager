<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'role' => 'RH',
            'email' => 'rh@gmail.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('admins')->insert([
            'role' => 'Finance',
            'email' => 'finance@gmail.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('admins')->insert([
            'role' => 'IT',
            'email' => 'it@gmail.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('admins')->insert([
            'role' => 'Marketing',
            'email' => 'marketing@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
