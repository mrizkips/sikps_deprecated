<?php

use App\Models\User;
use Illuminate\Database\Seeder;
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
        User::create([
            'nama' => 'Super Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin'),
            'role_id' => 1,
        ]);
    }
}
