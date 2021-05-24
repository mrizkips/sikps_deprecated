<?php

namespace App\Services;

use App\Models\Dosen;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DosenService
{
    /**
     * Insert data to user table and dosen table.
     *
     * @param array $data
     * @return \App\Models\User
     */
    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $data['password'] = Hash::make($data['password']);
            $role = Role::where('nama', 'dosen')->first();
            $data['role_id'] = $role->id;

            $user = new User();
            $user->fill($data);
            throw_unless($user->save(), new Exception());

            $user->dosen()->create($data);
            $commit = $user->fresh();
            DB::commit();
        } catch (Exception $e) {
            $commit = false;
            DB::rollBack();
        }

        return $commit;
    }

    /**
     * Update data user table and dosen table
     *
     * @param Dosen $dosen
     * @param array $data
     * @return \App\Models\User
     */
    public function update(Dosen $dosen, array $data)
    {
        DB::beginTransaction();
        try {
            $dosen->fill($data);
            throw_unless($dosen->update(), new Exception());

            $user_data = [
                'nama' => $data['nama'],
                'email' => $data['email'],
            ];

            if (isset($data['password'])) {
                $user_data['password'] = Hash::make($data['password']);
            }

            $dosen->user()->update($user_data);
            $commit = $dosen->fresh();
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
     * @param Dosen $dosen
     */
    public function delete(Dosen $dosen)
    {
        DB::beginTransaction();
        try {
            $commit = $dosen->user()->delete();
            DB::commit();
        } catch (Exception $e) {
            $commit = false;
            DB::rollBack();
        }

        return $commit;
    }
}
