<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PetugasRequest extends FormRequest
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
            'nip' => 'required',
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
            'nama' => trans('petugas.fields.nama'),
            'email' => trans('petugas.fields.email'),
            'nip' => trans('petugas.fields.nip'),
            'no_hp' => trans('petugas.fields.no_hp'),
            'jen_kel' => trans('petugas.fields.jen_kel'),
            'password' => trans('petugas.fields.password'),
        ];
    }
}
