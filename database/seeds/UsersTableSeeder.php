<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nama' => 'Admin',
            'email' => 'admin',
            'password' => Hash::make('admin'),
            'role_id' => 1,
        ], [
            'nama' => 'Keuangan',
            'email' => 'keuangan',
            'password' => Hash::make('keuangan'),
            'role_id' => 4,
        ], [
            'nama' => 'BAAK',
            'email' => 'baak',
            'password' => Hash::make('baak'),
            'role_id' => 5,
        ]);
    }
}
