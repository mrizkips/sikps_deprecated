<?php

namespace App\Services;

use App\Models\FormPenilaian;
use App\Models\FormPenilaianItem;
use App\Models\Penguji;
use App\Models\Pengujian;
use App\Models\Penilaian;
use App\Models\PenilaianItem;
use App\Models\Proposal;
use App\Models\Sidang;
use App\Models\User;
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
            $commit = false;
            DB::rollBack();
        }

        return $commit;
    }

    /**
     * Add penilaian.
     *
     * @param array $data
     * @param \App\Models\Pengujian $pengujian
     * @return bool
     */
    public function addPenilaian(array $data, Pengujian $pengujian)
    {
        DB::beginTransaction();
        try {
            $user_id = auth()->user()->id;

            $penilaian = Penilaian::create([
                'user_id' => $user_id,
                'pengujian_id' => $pengujian->id,
                'form_penilaian_id' => $data['form_penilaian_id'],
            ]);

            $form_penilaian_item = FormPenilaianItem::where('form_penilaian_id', $data['form_penilaian_id'])->get();

            unset($data['_token']);
            unset($data['form_penilaian_id']);

            $nilai = $data;
            $form_penilaian_item_id = $data;
            $is_numeric = [];

            foreach ($form_penilaian_item as $value) {
                $nama = str_replace([' '],'_',$value->nama)."_id";
                unset($nilai[$nama]);
                $nama = str_replace([' '],'_',$value->nama);
                unset($form_penilaian_item_id[$nama]);

                if (isset($value->min)) {
                    $is_numeric[$nama] = true;
                } else {
                    $is_numeric[$nama] = false;
                }
            }

            foreach ($nilai as $key => $value) {
                if ($is_numeric[$key]) {
                    $commit = PenilaianItem::create([
                        'penilaian_id' => $penilaian->id,
                        'form_penilaian_item_id' => $form_penilaian_item_id[$key."_id"],
                        'nilai' => $value,
                    ]);
                } else {
                    $commit = PenilaianItem::create([
                        'penilaian_id' => $penilaian->id,
                        'form_penilaian_item_id' => $form_penilaian_item_id[$key."_id"],
                        'keterangan' => $value,
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            $commit = false;
            DB::rollBack();
        }

        return $commit;
    }

    /**
     * Add penilaian.
     *
     * @param array $data
     * @param \App\Models\Penilaian $penilaian
     * @return bool
     */
    public function editPenilaian(array $data, Penilaian $penilaian)
    {
        DB::beginTransaction();
        try {
            $form_penilaian_item = FormPenilaianItem::where('form_penilaian_id', $data['form_penilaian_id'])->get();

            unset($data['_token']);
            unset($data['form_penilaian_id']);
            unset($data['_method']);

            $nilai = $data;
            $form_penilaian_item_id = $data;
            $is_numeric = [];

            foreach ($form_penilaian_item as $value) {
                $nama = str_replace([' '],'_',$value->nama)."_id";
                unset($nilai[$nama]);
                $nama = str_replace([' '],'_',$value->nama);
                unset($form_penilaian_item_id[$nama]);

                if (isset($value->min)) {
                    $is_numeric[$nama] = true;
                } else {
                    $is_numeric[$nama] = false;
                }
            }

            foreach ($nilai as $key => $value) {
                $penilaian_item = PenilaianItem::where([
                    ['penilaian_id', $penilaian->id],
                    ['form_penilaian_item_id', $form_penilaian_item_id[$key."_id"]],
                ])->first();

                if ($is_numeric[$key]) {
                    $commit = $penilaian_item->update([
                        'nilai' => $value,
                        'keterangan' => null,
                    ]);
                } else {
                    $commit = $penilaian_item->update([
                        'nilai' => null,
                        'keterangan' => $value,
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            $commit = false;
            DB::rollBack();
        }

        return $commit;
    }

    /**
     * Delete penilaian.
     *
     * @param \App\Models\Penilaian $penilaian
     * @return bool
     */
    public function deletePenilaian(Penilaian $penilaian)
    {
        DB::beginTransaction();
        try {
            $commit = $penilaian->delete();
            DB::commit();
        } catch (\Exception $e) {
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

    /**
     * Cek user adalah prodi untuk sidang.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Pengujian $pengujian
     * @return null|\App\Models\FormPenilaian
     */
    public function checkFormPenilaian(User $user, Pengujian $pengujian)
    {
        // Check role penilai
        $role = $user->role->nama;
        $jenis = $pengujian->sidang->jenis;

        if ($role == 'admin') {
            $penilai = FormPenilaian::IS_ADMIN;

            $form_penilaian = FormPenilaian::where([
                ['jenis', $jenis],
                ['penilai', $penilai]
            ])->first();

            return $form_penilaian;
        } else if ($role == 'dosen') {
            $penguji = Penguji::where([
                ['pengujian_id', $pengujian->id],
                ['dosen_id', $user->dosen->id],
            ]);

            if ($penguji->count() > 0) {
                $role = $penguji->first()->role;
                if ($role == 1) {
                    $penilai = FormPenilaian::IS_PENGUJI1;
                } else if ($role == 2) {
                    $penilai = FormPenilaian::IS_PENGUJI2;
                }
            }

            $proposal_count = Proposal::where([
                ['id', $pengujian->sidang->proposal_id],
                ['dosen_id', $user->dosen->id],
            ])->count();

            if ($proposal_count > 0) {
                $penilai = FormPenilaian::IS_PEMBIMBING;
            }

            $form_penilaian = FormPenilaian::where([
                ['jenis', $jenis],
                ['penilai', $penilai],
            ])->first();

            return $form_penilaian;
        }

        return null;
    }
}
