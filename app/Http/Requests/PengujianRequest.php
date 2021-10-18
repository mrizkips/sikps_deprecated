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
                'sidang_id' => ['required|exists:sidang,id'],
                'tanggal' => 'required|date',
                'mulai' => 'required|date_format:H:i',
                'selesai' => 'required|date_format:H:i|after_or_equal:mulai',
                'ruangan' => 'required|string',
                'catatan' => 'required|string',
            ];
        }

        return [
            'pendaftaran_id' => 'required|exists:pendaftaran,id',
            'sidang_id' => 'required|exists:sidang,id',
            'tanggal' => 'required|date',
            'mulai' => 'required|date_format:H:i',
            'selesai' => 'required|date_format:H:i|after_or_equal:mulai',
            'ruangan' => 'required|string',
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
            'pendaftaran_id' => trans('pengujian.fields.pendaftaran_id'),
            'sidang_id' => trans('pengujian.fields.sidang_id'),
            'tanggal' => trans('pengujian.fields.tanggal'),
            'mulai' => trans('pengujian.fields.mulai'),
            'selesai' => trans('pengujian.fields.selesai'),
            'ruangan' => trans('pengujian.fields.ruangan'),
            'catatan' => trans('pengujian.fields.catatan'),
        ];
    }
}
