<?php

namespace App\Services;

use App\Models\Approval;
use App\Models\Sidang;
use App\Models\Role;
use Exception;
use Illuminate\Support\Facades\DB;

class SidangService
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
}
