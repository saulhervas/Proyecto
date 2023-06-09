<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidacionContactoWeb;
use App\Models\ContactoWeb;
use Illuminate\Http\Request;

class ContactoWebController extends Controller
{
    /**
     * guarda los datos de contacto y el mensaje proporcionados por el usuario
     */
    public function guardar(ValidacionContactoWeb $request)
    {
        ContactoWeb::create($request->all());

        return redirect()->back()->with('mensaje', 'Gracias por ponerse en contacto con nosotros.');
    }
}
