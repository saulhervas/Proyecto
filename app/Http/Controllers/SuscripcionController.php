<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidacionSuscripcion;
use App\Models\Suscripcion;
use App\Notifications\Suscripciones;
use Illuminate\Http\Request;

class SuscripcionController extends Controller
{
    public function suscripcion(ValidacionSuscripcion $request)
    {
        $data = $request->all();
        $data['activo'] = 1;
        if($suscripcion = Suscripcion::where('email',$data['email'])->first()) $suscripcion->update(['activo' => 1]);
        else $suscripcion = Suscripcion::create($data);
        $suscripcion->notify(new Suscripciones($suscripcion));

        return redirect()->back()->with('mensaje', 'Su suscripcion ha sido registrada correctamente, !gracias!');
    }

    public function cancelar($id)
    {
        $suscripcion = Suscripcion::findOrFail($id);
        $suscripcion->update(['activo' => 0]);
        $suscripcion->notify(new Suscripciones($suscripcion));

        return redirect()->back();
    }
}
