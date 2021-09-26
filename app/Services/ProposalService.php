<?php

namespace App\Services;

use App\Models\Approval;
use App\Models\Proposal;
use App\Models\Role;
use Exception;
use Illuminate\Support\Facades\DB;

class ProposalService
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
            # Tempat KP
            if ($data['jenis'] == 1) {
                $data['tempat_kp'] = null;
            }

            # Buat Proposal
            $proposal = new Proposal();
            $proposal->fill($data);
            throw_unless($proposal->save(), new Exception());

            # Buat Status
            $status = ['tipe' => '0'];
            throw_unless($proposal->status()->create($status), new Exception());

            # Buat Approval
            $roles = Role::where('nama', 'admin')
            ->orWhere('nama', 'keuangan')
            ->orWhere('nama', 'baak')
            ->get();

            foreach ($roles as $role) {
                $data = [
                    $status,
                    'role_id' => $role->id,
                    'status_id' => $proposal->status->id,
                ];

                $approval = new Approval();
                throw_unless($approval->fill($data)->save(), new Exception());
            }

            $commit = $proposal->fresh();
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
     * @param Proposal $proposal
     * @param array $data
     * @return \App\Models\User
     */
    public function update(Proposal $proposal, array $data)
    {
        DB::beginTransaction();
        try {
            # Tempat KP
            if (isset($data['jenis']) && $data['jenis'] == 1) {
                $data['tempat_kp'] = null;
            }

            $proposal->fill($data);
            $commit = $proposal->update();
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
     * @param Proposal $proposal
     */
    public function delete(Proposal $proposal)
    {
        DB::beginTransaction();
        try {
            throw_unless($proposal->status()->delete(), new Exception());
            $commit = $proposal->delete();
            DB::commit();
        } catch (Exception $e) {
            $commit = false;
            DB::rollBack();
        }

        return $commit;
    }

    /**
     * Approve or disapprove proposal
     *
     * @param Proposal $proposal
     * @param array $data
     */
    public function approval(Proposal $proposal, array $data)
    {
        DB::beginTransaction();
        try {
            # Preparing data
            $user = auth()->user();
            $status = $proposal->status;
            $approval = Approval::where([
                ['status_id', '=', $status->id],
                ['role_id', '=', $user->role_id]
            ])->first();

            # Make approval
            $approval->fill($data);
            throw_unless($approval->update(), new Exception());
            $commit = $approval->fresh();

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
