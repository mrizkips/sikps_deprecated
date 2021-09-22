<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProposalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'judul' => 'required|string',
            'jenis' => 'required|in:Skripsi,Kerja Praktek',
            'dokumen' => 'mimes:pdf|max:2048',
            'pendaftaran_id' => 'required|exists:pendaftaran,id',
            'kbb_id' => 'required|exists:kbb,id',
            'tanggal_kontrak' => 'required|date',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'judul' => trans('proposal.fields.judul'),
            'jenis' => trans('proposal.fields.jenis'),
            'dokumen' => trans('proposal.fields.dokumen'),
            'pendaftaran_id' => trans('proposal.fields.pendaftaran_id'),
            'kbb_id' => trans('proposal.fields.kbb_id'),
            'tanggal_kontrak' => trans('proposal.fields.tanggal_kontrak'),
        ];
    }
}
