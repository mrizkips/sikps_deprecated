<?php

namespace App\Services;

use App\Models\Penguji;
use App\Models\Pengujian;
use App\Models\Sidang;
use Illuminate\Database\Eloquent\Builder;
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
        } catch (\Exception $e) {
            info('Error pengujian service create', $e);
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
        } catch (\Exception $e) {
            info('Error pengujian service update', $e);
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
        } catch (\Exception $e) {
            info('Error pengujian service delete', $e);
            $commit = false;
            DB::rollBack();
        }

        return $commit;
    }

    /**
     * Add penguji.
     *
     * @param array $data
     * @param \App\Models\Pengujian
     * @return bool
     */
    public function createPenguji(array $data, Pengujian $pengujian)
    {
        DB::beginTransaction();
        try {
            $data['pengujian_id'] = $pengujian->id;
            $data['role'] = $pengujian->penguji->count() + 1;

            $penguji = new Penguji();
            $penguji->fill($data);
            $commit = $penguji->save();
            DB::commit();
        } catch (\Exception $e) {
            info('Error pengujian service add penguji', $e);
            $commit = false;
            DB::rollBack();
        }

        return $commit;
    }

    /**
     * Edit penguji.
     *
     * @param array $data
     * @param \App\Models\Penguji $penguji
     * @return bool
     */
    public function editPenguji(array $data, Penguji $penguji)
    {
        DB::beginTransaction();
        try {
            $commit = $penguji->update($data);
            DB::commit();
        } catch (\Exception $e) {
            info('Error pengujian service edit penguji', $e);
            $commit = false;
            DB::rollBack();
        }

        return $commit;
    }

    /**
     * Delete penguji.
     *
     * @param \App\Models\Penguji $penguji
     * @return bool
     */
    public function deletePenguji(Penguji $penguji)
    {
        DB::beginTransaction();
        try {
            $commit = $penguji->delete();
            DB::commit();
        } catch (\Exception $e) {
            info('Error pengujian service delete penguji', $e);
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
     * Check if sidang already created in the same pendaftaran.
     *
     * @param int $pendaftaran_id
     * @param int $sidang_id
     * @return bool
     */
    public function isExisted($pendaftaran_id, $sidang_id)
    {
        $count = Pengujian::where([
            ['pendaftaran_id', $pendaftaran_id],
            ['sidang_id', $sidang_id]
        ])->count();
        return ($count > 0);
    }

    /**
     * Check if sidang already created in the same pendaftaran.
     *
     * @param \App\Models\Pengujian $pengujian
     * @return bool
     */
    public function pengujiIsFull(Pengujian $pengujian)
    {
        if ($pengujian->sidang->jenis == 3) {
            return ($pengujian->penguji->count() == 1);
        } else {
            return ($pengujian->penguji->count() == 2);
        }
    }

    /**
     * Get fields by pendaftaran_id.
     *
     * @param int $pendaftaran_id
     * @return mixed
     */
    public function getFields($pendaftaran_id)
    {
        $html = "<option>".trans('pengujian.placeholders.sidang_id')."</option>";

        $sidang = Sidang::where('pendaftaran_id', $pendaftaran_id)->whereHas('status', function(Builder $query) {
            $query->where('tipe', '1');
        })->get();

        if ($sidang->isNotEmpty()) {
            foreach ($sidang as $value) {
                $html .= "<option value='{$value->id}'>{$value->proposal->judul} - {$value->proposal->mahasiswa->user->nama}</option>";
            }
        }

        return $html;
    }
}
