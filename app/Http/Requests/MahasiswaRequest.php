<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
            'kbb_id' => 'required|exists:kbb,id',
            'jurusan_id' => 'required|exists:jurusan,id',
            'jen_kel' => ['required', Rule::in(config('constant.jen_kel'))],
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
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
            'kbb_id' => trans('mahasiswa.fields.kbb_id'),
            'jurusan_id' => trans('mahasiswa.fields.jurusan_id'),
            'jen_kel' => trans('mahasiswa.fields.jen_kel'),
            'tempat_lahir' => trans('mahasiswa.fields.tempat_lahir'),
            'tanggal_lahir' => trans('mahasiswa.fields.tanggal_lahir'),
            'alamat' => trans('mahasiswa.fields.alamat'),
            'password' => trans('mahasiswa.fields.password'),
        ];
    }
}
