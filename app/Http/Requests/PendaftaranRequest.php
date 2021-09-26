<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PendaftaranRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check('admin');
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
            'awal' => 'required|date',
            'akhir' => 'required|date|after_or_equal:awal',
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
            'judul' => trans('pendaftaran.fields.judul'),
            'jenis' => trans('pendaftaran.fields.jenis'),
            'awal' => trans('pendaftaran.fields.awal'),
            'akhir' => trans('pendaftaran.fields.akhir'),
            'tanggal_kontrak' => trans('pendaftaran.fields.tanggal_kontrak'),
        ];
    }
}
