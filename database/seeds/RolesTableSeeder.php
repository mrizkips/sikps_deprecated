<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'superadmin',
            'admin',
            'mahasiswa',
            'dosen',
            'keuangan',
            'baak',
        ];

        foreach ($roles as $role) {
            Role::create(['nama' => $role]);
        }
    }
}
