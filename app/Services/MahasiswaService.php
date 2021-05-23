<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaService
{
    /**
     * Insert data to user table and mahasiswa table.
     *
     * @param array $data
     * @return \App\Models\User
     */
    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $data['password'] = Hash::make($data['password']);
            $role = Role::where('nama', 'mahasiswa')->first();
            $data['role_id'] = $role->id;

            $user = new User();
            $user->fill($data);
            throw_unless($user->save(), new Exception());

            $user->mahasiswa()->create($data);
            $commit = $user->fresh();
            DB::commit();
        } catch (Exception $e) {
            $commit = false;
            DB::rollBack();
        }

        return $commit;
    }
}
