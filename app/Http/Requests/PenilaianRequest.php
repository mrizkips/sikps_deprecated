<?php

namespace App\Http\Requests;

use App\Models\FormPenilaianItem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PenilaianRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $form_penilaian_items = FormPenilaianItem::where('form_penilaian_id', $request->only('form_penilaian_id'))->orderBy('id', 'asc')->get();

        $rules = [];
        foreach ($form_penilaian_items as $item) {
            $nama = str_replace([' '],'_',$item->nama);
            if (isset($item->min)) {
                $rules[$nama] = ['required', 'numeric', "min:{$item->min}", "max:{$item->max}"];
            } else {
                $rules[$nama] = ['required', 'string'];
            }
        }

        return $rules;
    }
}
