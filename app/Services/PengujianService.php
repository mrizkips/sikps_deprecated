<?php

namespace App\Services;

use App\Models\Pengujian;
use App\Models\Sidang;
use Exception;
use Illuminate\Support\Facades\DB;

class PengujianService
{
    /**
     * Insert data.
     *
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $pengujian = new Pengujian();
            $pengujian->fill($data);
            $commit = $pengujian->save();
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
     * @param \App\Models\Pengujian $pengujian
     * @return bool
     */
    public function update(array $data, Pengujian $pengujian)
    {
        DB::beginTransaction();
        try {
            $commit = $pengujian->update($data);
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
     * @param \App\Models\Pengujian $pengujian
     * @return bool
     */
    public function delete(Pengujian $pengujian)
    {
        DB::beginTransaction();
        try {
            $commit = $pengujian->delete();
            DB::commit();
        } catch (Exception $e) {
            $commit = false;
            DB::rollBack();
        }

        return $commit;
    }

    /**
     * Check if dosen pembimbing equal dosen penguji.
     *
     * @param int $penguji
     * @param int $sidang_id
     * @return bool
     */
    public function pembimbingEqualPenguji($penguji, $sidang_id)
    {
        $sidang = Sidang::find($sidang_id);
        return ($penguji == $sidang->proposal->dosen_id);
    }

    /**
     * Check if sidang already created in the same jadwal_sidang.
     *
     * @param int $jadwal_sidang_id
     * @param int $sidang_id
     * @return bool
     */
    public function isExisted($jadwal_sidang_id, $sidang_id)
    {
        $count = Pengujian::where([
            ['jadwal_sidang_id', $jadwal_sidang_id],
            ['sidang_id', $sidang_id]
        ])->count();
        return ($count > 0);
    }
}
