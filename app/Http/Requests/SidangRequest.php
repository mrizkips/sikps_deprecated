<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SidangRequest extends FormRequest
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
            'jenis' => 'required|in:1,2,3',
            'proposal_id' => 'required|exists:proposal,id',
            'pendaftaran_id' => 'required|exists:pendaftaran,id',
            'laporan' => 'mimes:pdf|max:2048',
            'penilaian_kp' => 'mimes:pdf|max:10240',
            'catatan' => 'nullable|string',
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
            'jenis' => trans('sidang.fields.jenis'),
            'proposal_id' => trans('sidang.fields.proposal_id'),
            'pendaftaran_id' => trans('sidang.fields.pendaftaran_id'),
            'laporan' => trans('sidang.fields.laporan'),
            'penilaian_kp' => trans('sidang.fields.penilaian_kp'),
            'catatan' => trans('sidang.fields.catatan'),
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
            'penilaian_kp.required_if'  => ':Attribute wajib diisi bila :other adalah '.config('constant.jenis_sidang.3'),
        ];
    }
}
