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
            'jenis' => 'required|in:1,2',
            'dokumen' => 'mimes:pdf|max:2048',
            'pendaftaran_id' => 'required|exists:pendaftaran,id',
            'tempat_kp' => 'required_if:jenis,2',
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
            'tempat_kp' => trans('proposal.fields.tempat_kp'),
        ];
    }

    /**
 * Get the error messages for the defined validation rules.
 *
 * @return array
 */
public function messages()
{
    return [
        'tempat_kp.required_if'  => 'Tempat KP wajib diisi bila :other adalah '.config('constant.jenis_proposal.2'),
    ];
}
}
