<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionGaleria extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->route('unitario') || $this->route('id')) {
            return [
                'referencia_vista' => 'nullable|max:50',
                'foto' => 'nullable|mimes:jpeg,png,gif,jpg',
            ];
        }else{
            return [
                'referencia_vista' => 'nullable|max:50',
                'fotos' => 'required|array',
                'fotos.*' => [
                    'mimes:jpeg,png,gif,jpg'
                ]
            ];
        }
    }
}
