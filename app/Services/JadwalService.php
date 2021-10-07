<?php

namespace App\Services;

use App\Models\Jadwal;
use App\Models\Dosen;
use Exception;
use Illuminate\Support\Facades\DB;

class JadwalService
{
    /**
     * Insert data.
     *
     * @param array $data
     * @return bool
     */
    public function create(array $data, Dosen $dosen)
    {
        DB::beginTransaction();
        try {
            $data['pin'] = pin_generator(6);
            $data['dosen_id'] = $dosen->id;

            $jadwal = new Jadwal();
            $jadwal->fill($data);
            $commit = $jadwal->save();
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
     * @param \App\Models\Jadwal $jadwal
     * @return bool
     */
    public function update(array $data, Jadwal $jadwal)
    {
        DB::beginTransaction();
        try {
            $commit = $jadwal->update($data);
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
     * @param \App\Models\Jadwal $jadwal
     * @return bool
     */
    public function delete(Jadwal $jadwal)
    {
        DB::beginTransaction();
        try {
            $commit = $jadwal->delete();
            DB::commit();
        } catch (Exception $e) {
            $commit = false;
            DB::rollBack();
        }

        return $commit;
    }
}
