<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FormPenilaianItemRequest extends FormRequest
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
            'nama' => 'required|string',
            'min' => 'nullable|numeric|min:0|max:100|lt:max|required_without:isian_text',
            'max' => 'nullable|numeric|min:0|max:100|gt:min|required_without:isian_text',
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
            'nama' => trans('form_penilaian_item.fields.nama'),
            'min' => trans('form_penilaian_item.fields.min'),
            'max' => trans('form_penilaian_item.fields.max'),
            'isian_text' => trans('form_penilaian_item.fields.isian_text'),
        ];
    }
}
