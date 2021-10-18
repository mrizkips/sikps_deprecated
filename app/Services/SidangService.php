<?php

namespace App\Services;

use App\Models\Approval;
use App\Models\Pendaftaran;
use App\Models\Proposal;
use App\Models\Sidang;
use App\Models\Role;
use App\Traits\Uploadable;
use Exception;
use Illuminate\Support\Facades\DB;

class SidangService
{
    use Uploadable;

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
            # Form Penilaian KP
            if ($data['jenis'] != 3) {
                $data['laporan_kp'] = null;
            }

            # Buat Sidang
            $sidang = new Sidang();
            $sidang->fill($data);
            throw_unless($sidang->save(), new Exception());

            # Buat Status
            $status = ['tipe' => '0'];
            throw_unless($sidang->status()->create($status), new Exception());

            # Buat Approval
            $roles = Role::where('nama', 'dosen')
            ->get();

            foreach ($roles as $role) {
                $data = [
                    $status,
                    'role_id' => $role->id,
                    'status_id' => $sidang->status->id,
                ];

                $approval = new Approval();
                throw_unless($approval->fill($data)->save(), new Exception());
            }

            $commit = $sidang->fresh();
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
     * @param Sidang $sidang
     * @param array $data
     * @return \App\Models\User
     */
    public function update(Sidang $sidang, array $data)
    {
        DB::beginTransaction();
        try {
            $sidang->fill($data);
            $commit = $sidang->update();
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
     * @param Sidang $sidang
     */
    public function delete(Sidang $sidang)
    {
        DB::beginTransaction();
        try {
            throw_unless($sidang->status()->delete(), new Exception());
            if (isset($sidang->penilaian_kp)) {
                $this->deleteFile($sidang->penilaian_kp);
            }
            $this->deleteFile($sidang->laporan);
            $commit = $sidang->delete();
            DB::commit();
        } catch (Exception $e) {
            $commit = false;
            DB::rollBack();
        }

        return $commit;
    }

    /**
     * Approve or disapprove sidang
     *
     * @param Sidang $sidang
     * @param array $data
     */
    public function approval(Sidang $sidang, array $data)
    {
        DB::beginTransaction();
        try {
            # Preparing data
            $user = auth()->user();
            $status = $sidang->status;
            $approval = Approval::where([
                ['status_id', '=', $status->id],
                ['role_id', '=', $user->role_id]
            ])->first();

            # Make approval
            $approval->fill($data);
            throw_unless($approval->update(), new Exception());
            $commit = $approval->fresh();

            # Generate approval when dosen approved
            if ($approval->role_id == 3 && $approval->tipe == 1) {
                $roles = Role::where('nama', 'admin')
                    ->orWhere('nama', 'keuangan')
                    ->orWhere('nama', 'baak')
                    ->get();

                foreach ($roles as $key => $value) {
                    $role_ids[$key] = $value->id;
                }

                $count = Approval::where('status_id', $status->id)->whereIn('role_id', $role_ids)->count();

                if ($count == 0) {
                    foreach ($roles as $role) {
                        $fresh_data = [
                            'tipe' => '0',
                            'role_id' => $role->id,
                            'status_id' => $status->id,
                        ];

                        $approval = new Approval();
                        throw_unless($approval->fill($fresh_data)->save(), new Exception());
                    }
                }
            }

            # Check all approved and disapproved
            $denied = 0;
            $waiting = 0;
            $list_approval = Approval::where('status_id', $status->id)->get();
            foreach ($list_approval as $list) {
                if ($list->tipe == "2") {
                    $denied += 1;
                } else if ($list->tipe == "0") {
                    $waiting += 1;
                }
            }

            # Set waiting status
            if ($waiting > 0) {
                $status->tipe = "0";
                $commit = $status->update();
            }


            # Set disapproved status
            if ($denied > 0) {
                $status->tipe = "2";
                $commit = $status->update();
            }

            # Set approved status
            if ($denied == 0 && $waiting == 0) {
                $status->tipe = "1";
                $commit = $status->update();
            }

            DB::commit();
        } catch (Exception $e) {
            $commit = false;
            DB::rollBack();
        }

        return $commit;
    }

    /**
     * Get proposal by jenis.
     *
     * @param int $jenis
     * @return mixed
     */
    public function getProposal($jenis)
    {
        $mahasiswa = auth()->user()->mahasiswa;
        $html = "<option>".trans('sidang.placeholders.proposal_id')."</option>";

        if ($jenis == 3) {
            $proposal = Proposal::approved()->kp()->where('mahasiswa_id', $mahasiswa->id)->get();
        } else if ($jenis == 1 || $jenis == 2) {
            $proposal = Proposal::approved()->skripsi()->where('mahasiswa_id', $mahasiswa->id)->get();
        }

        if (isset($proposal)) {
            foreach ($proposal as $value) {
                $html .= "<option value='{$value->id}'>{$value->judul}</option>";
            }
        }

        return $html;
    }

    /**
     * Check proposal duplication in the same pendaftaran.
     *
     * @param \App\Models\Pendaftaran $pendaftaran
     * @param \App\Models\Proposal $proposal
     * @return bool
     */
    public function isDuplicate(Pendaftaran $pendaftaran, Proposal $proposal)
    {
        $count = Sidang::where([
            ['pendaftaran_id', $pendaftaran->id],
            ['proposal_id', $proposal->id],
        ])->count();

        return ($count > 0);
    }

    /**
     * Check jenis equals proposal jenis.
     *
     * @param mixed $jenis
     * @param \App\Models\Proposal $proposal
     * @return bool
     */
    public function jenisEqualProposal($jenis, Proposal $proposal)
    {
        $jenis_proposal = $proposal->jenis;

        if ($jenis_proposal == '2' && $jenis == '3') {
            return true;
        } else if ($jenis_proposal == '1' && ($jenis == '1' || $jenis == '2')) {
            return true;
        }

        return false;
    }
}
