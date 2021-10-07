<?php

namespace App\Services;

use App\Models\Bimbingan;
use App\Models\Jadwal;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Exception;
use Illuminate\Support\Facades\DB;

class BimbinganService
{
    /**
     * Insert data.
     *
     * @param array $data
     * @param \App\Models\Mahasiswa $mahasiswa
     * @return bool
     */
    public function create(array $data, Mahasiswa $mahasiswa)
    {
        DB::beginTransaction();
        try {
            $data['mahasiswa_id'] = $mahasiswa->id;
            $bimbingan = new Bimbingan();
            $bimbingan->fill($data);
            $commit = $bimbingan->save();
            DB::commit();
        } catch (Exception $e) {
            $commit = false;
            DB::rollBack();
        }

        return $commit;
    }

    /**
     * Update data.
     *
     * @param array $data
     * @param \App\Models\Bimbingan $jadwal
     * @return bool
     */
    public function update(array $data, Bimbingan $bimbingan)
    {
        DB::beginTransaction();
        try {
            $commit = $bimbingan->update($data);
            DB::commit();
        } catch (Exception $e) {
            $commit = false;
            DB::rollBack();
        }

        return $commit;
    }

    /**
     * Delete data.
     *
     * @param \App\Models\Bimbingan $bimbingan
     * @return bool
     */
    public function delete(Bimbingan $bimbingan)
    {
        DB::beginTransaction();
        try {
            $commit = $bimbingan->delete();
            DB::commit();
        } catch (Exception $e) {
            $commit = false;
            DB::rollBack();
        }

        return $commit;
    }
}
