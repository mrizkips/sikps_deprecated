<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MahasiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check(['admin', 'mahasiswa']);
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
            'nim' => 'required',
            'no_hp' => 'required|alpha_num',
            'jen_kel' => 'required|in:Laki-laki,Perempuan',
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
            'nama' => trans('mahasiswa.fields.nama'),
            'email' => trans('mahasiswa.fields.email'),
            'nim' => trans('mahasiswa.fields.nim'),
            'no_hp' => trans('mahasiswa.fields.no_hp'),
            'jen_kel' => trans('mahasiswa.fields.jen_kel'),
            'password' => trans('mahasiswa.fields.password'),
        ];
    }
}
