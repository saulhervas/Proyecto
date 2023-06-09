<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionReserva extends FormRequest
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
        return [
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'required|date',
            'num_adultos' => 'required|integer',
            'num_ninios' => 'required|integer',
            'num_habitaciones' => 'required|integer',
            'tipo_habitacion_id' => 'required'
        ];
    }
}
