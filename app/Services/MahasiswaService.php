<?php

namespace App\Services;

use App\Models\Mahasiswa;
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

    /**
     * Update data user table and mahasiswa table
     *
     * @param Mahasiswa $mahasiswa
     * @param array $data
     * @return \App\Models\User
     */
    public function update(Mahasiswa $mahasiswa, array $data)
    {
        DB::beginTransaction();
        try {
            $mahasiswa->fill($data);
            throw_unless($mahasiswa->update(), new Exception());

            $user_data = [
                'nama' => $data['nama'],
            ];

            if (isset($data['password'])) {
                $user_data['password'] = Hash::make($data['password']);
            }

            $mahasiswa->user()->update($user_data);
            $commit = $mahasiswa->fresh();
            DB::commit();
        } catch (Exception $e) {
            $commit = false;
            DB::rollBack();
        }

        return $commit;
    }

    /**
     * Delete data
     *
     * @param Mahasiswa $mahasiswa
     */
    public function delete(Mahasiswa $mahasiswa)
    {
        DB::beginTransaction();
        try {
            $commit = $mahasiswa->user()->delete();
            DB::commit();
        } catch (Exception $e) {
            $commit = false;
            DB::rollBack();
        }

        return $commit;
    }
}
