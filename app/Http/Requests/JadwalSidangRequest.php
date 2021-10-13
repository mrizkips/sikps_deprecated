<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class JadwalSidangRequest extends FormRequest
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
            'pendaftaran_id' => 'required|exists:pendaftaran,id',
            'tanggal' => 'required|date',
            'mulai' => 'required|date_format:H:i',
            'selesai' => 'required|date_format:H:i|after_or_equal:mulai',
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
            'pendaftaran_id' => trans('jadwal_sidang.fields.pendaftaran_id'),
            'tanggal' => trans('jadwal_sidang.fields.tanggal'),
            'mulai' => trans('jadwal_sidang.fields.mulai'),
            'selesai' => trans('jadwal_sidang.fields.selesai'),
            'catatan' => trans('jadwal_sidang.fields.catatan'),
        ];
    }
}
