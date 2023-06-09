<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionCliente extends FormRequest
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
            'nombre' => 'required|max:200',
            'apellidos' => 'nullable|max:200',
            'fecha_nacimiento' => 'nullable|date',
            'sexo' => 'nullable|max:50',
            'foto.*' => 'nullable|image|max:10000',
            'dni' => 'required|max:20',
            'direccion' => 'nullable|max:200',
            'email' => 'nullable|email',
        ];
    }
}
