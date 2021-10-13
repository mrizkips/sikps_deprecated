<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PengujianRequest extends FormRequest
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
        if (Auth::guard('dosen')->check()) {
            return [
                'pendaftaran_id' => 'required|exists:pendaftaran,id',
                'jadwal_sidang_id' => 'required|exists:jadwal_sidang,id',
                'sidang_id' => 'required|exists:sidang,id',
                'dosen_id' => 'required|exists:dosen,id',
                'nilai_ppt' => 'required|numeric|min:0|max:100',
                'nilai_laporan' => 'required|numeric|min:0|max:100',
                'nilai_aplikasi' => 'required|numeric|min:0|max:100',
            ];
        }

        return [
            'pendaftaran_id' => 'required|exists:pendaftaran,id',
            'jadwal_sidang_id' => 'required|exists:jadwal_sidang,id',
            'sidang_id' => 'required|exists:sidang,id',
            'dosen_id' => 'required|exists:dosen,id',
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
            'pendaftaran_id' => trans('pengujian.fields.pendaftaran_id'),
            'jadwal_sidang_id' => trans('pengujian.fields.jadwal_sidang_id'),
            'sidang_id' => trans('pengujian.fields.sidang_id'),
            'dosen_id' => trans('pengujian.fields.dosen_id'),
            'nilai_ppt' => trans('pengujian.fields.nilai_ppt'),
            'nilai_laporan' => trans('pengujian.fields.nilai_laporan'),
            'nilai_aplikasi' => trans('pengujian.fields.nilai_aplikasi'),
        ];
    }
}
