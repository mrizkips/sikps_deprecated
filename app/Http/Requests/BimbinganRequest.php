<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BimbinganRequest extends FormRequest
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
            'jadwal_id' => 'required|exists:jadwal,id',
            'proposal_id' => 'required|exists:proposal,id',
            'catatan' => 'required|string',
            'pin' => 'required|string|digits:6',
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
            'jadwal_id' => trans('bimbingan.fields.jadwal_id'),
            'proposal_id' => trans('bimbingan.fields.proposal_id'),
            'catatan' => trans('bimbingan.fields.catatan'),
            'pin' => trans('bimbingan.fields.pin')
        ];
    }
}
