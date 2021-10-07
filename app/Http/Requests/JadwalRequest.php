<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class JadwalRequest extends FormRequest
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
            'tanggal' => 'required|date',
            'mulai' => 'required|date_format:H:i',
            'selesai' => 'required|date_format:H:i|after_or_equal:mulai',
            'link' => 'nullable|string',
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
            'tanggal' => trans('jadwal.fields.tanggal'),
            'mulai' => trans('jadwal.fields.mulai'),
            'selesai' => trans('jadwal.fields.selesai'),
            'link' => trans('jadwal.fields.link'),
            'catatan' => trans('jadwal.fields.catatan'),
        ];
    }
}
