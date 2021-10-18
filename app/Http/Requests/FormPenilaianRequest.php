<?php

namespace App\Http\Requests;

use App\Models\FormPenilaian;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class FormPenilaianRequest extends FormRequest
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
        $jenis = [];
        foreach (FormPenilaian::JENIS as $key => $value) {
            array_push($jenis,$key);
        }

        $penilai = [];
        foreach (FormPenilaian::PENILAI as $key => $value) {
            array_push($penilai, $key);
        }

        return [
            'nama' => 'required|string',
            'jenis' => ['required', Rule::in($jenis)],
            'penilai' => ['required', Rule::in($penilai)],
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
            'nama' => trans('form_penilaian.fields.nama'),
            'jenis' => trans('form_penilaian.fields.jenis'),
            'penilai' => trans('form_penilaian.fields.penilai'),
        ];
    }
}
