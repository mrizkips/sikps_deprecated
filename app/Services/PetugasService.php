<?php

namespace App\Services;

use App\Models\Baak;
use App\Models\Dosen;
use App\Models\Keuangan;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PetugasService
{
    /**
     * Insert data to user table and keuangan table.
     *
     * @param array $data
     * @return \App\Models\User
     */
    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $data['password'] = Hash::make($data['password']);

            $user = new User();
            $user->fill($data);
            throw_unless($user->save(), new Exception());

            if ($data['role_id'] == 4) {
                $user->keuangan()->create($data);
            } else {
                $user->baak()->create($data);
            }
            $commit = $user->fresh();
            DB::commit();
        } catch (Exception $e) {
            $commit = false;
            DB::rollBack();
        }

        return $commit;
    }

    /**
     * Update data user table and keuangan table
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\User
     */
    public function update($id, array $data)
    {
        DB::beginTransaction();
        try {

            $user = User::find($id);
            if ($user->role_id == 4) {
                $petugas = $user->keuangan;
            } else {
                $petugas = $user->baak;
            }

            $petugas->fill($data);
            throw_unless($petugas->update(), new Exception());

            $user_data = [
                'nama' => $data['nama'],
                'email' => $data['email'],
            ];

            if (isset($data['password'])) {
                $user_data['password'] = Hash::make($data['password']);
            }

            $user->update($user_data);
            $commit = $user->fresh();
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
     * @param int $id
     */
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);
            $commit = $user->delete();
            DB::commit();
        } catch (Exception $e) {
            $commit = false;
            DB::rollBack();
        }

        return $commit;
    }
}
