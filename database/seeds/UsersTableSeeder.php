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
        $data = [
            [
                'nama' => 'Admin',
                'email' => 'admin',
                'password' => Hash::make('admin'),
                'role_id' => 1,
            ],
            [
                'nama' => 'Petugas Keuangan',
                'email' => 'keuangan',
                'password' => Hash::make('keuangan'),
                'role_id' => 4,
            ],
            [
                'nama' => 'Petugas BAAK',
                'email' => 'baak',
                'password' => Hash::make('baak'),
                'role_id' => 5,
            ]
        ];

        foreach ($data as $value) {
            DB::table('users')->insert($value);
        }

        DB::table('keuangan')->insert([
            'nip' => '123456',
            'user_id' => '2',
            'no_hp' => '123456',
            'jen_kel' => 'Laki-laki',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('baak')->insert([
            'nip' => '123456',
            'user_id' => '3',
            'no_hp' => '123456',
            'jen_kel' => 'Laki-laki',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
