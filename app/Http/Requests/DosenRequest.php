<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DosenRequest extends FormRequest
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
            'nama' => 'required|string',
            'email' => 'required|email',
            'nidn' => 'required',
            'no_hp' => 'required|alpha_num',
            'jen_kel' => 'required|in:Laki-laki,Perempuan',
            'keahlian' => 'nullable|string',
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
            'nama' => trans('dosen.fields.nama'),
            'email' => trans('dosen.fields.email'),
            'nidn' => trans('dosen.fields.nidn'),
            'no_hp' => trans('dosen.fields.no_hp'),
            'jen_kel' => trans('dosen.fields.jen_kel'),
            'keahlian' => trans('dosen.fields.keahlian'),
            'password' => trans('dosen.fields.password'),
        ];
    }
}
