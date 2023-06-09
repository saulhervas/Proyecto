<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidacionGaleria;
use App\Models\Galeria;
use App\Models\Servicio;
use App\Models\TipoHabitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriaController extends Controller
{
    /**
     * Mostrar un listado de personal.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Galeria::get();
        return view('galeria.index', compact('datas'));
    }

    /**
     * Mostrar el formulario para crear una ficha de personal.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear($unitario=null)
    {
        can('añadir-fotos');

        if($unitario != null){
            $tipo_habitaciones = TipoHabitacion::get()->pluck('nombre', 'id')->toArray();
            $servicios = Servicio::get()->pluck('nombre', 'id')->toArray();
            return view('galeria.crear', compact('servicios', 'tipo_habitaciones','unitario'));
        }else{

            return view('galeria.crear');
        }

    }

    /**
     * Guardar una nueva ficha de personal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(ValidacionGaleria $request, $unitario=null)
    {
        can('añadir-fotos');

        if($unitario != null){
            $requestData = $request->except('foto');

            if ($foto = Galeria::setArchivo($request->file('foto'), 'galeria/')) {
                $requestData['foto'] = $foto;
            }

            Galeria::create($requestData);

        }else{

            foreach($request->file('fotos') as $foto){
                $data['foto'] = Galeria::setArchivo($foto, 'galeria/');
                Galeria::create($data);
            }
        }

        return redirect('galeria')->with('mensaje', 'Foto agregada a la galeria con exito');
    }

    /**
     * Mostrar el formulario para editar una foto.
     *
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        can('ver-fotos');
        $data = Galeria::findOrFail($id);
        $editar =1;
        $tipo_habitaciones = TipoHabitacion::get()->pluck('nombre', 'id')->toArray();
        $servicios = Servicio::get()->pluck('nombre', 'id')->toArray();

        if(isset($data->foto)) $data->foto = "galeria/$data->foto";

        return view('galeria.editar', compact('data', 'editar','tipo_habitaciones','servicios'));
    }

    /**
     * Guardar una nueva ficha de personal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function actualizar(ValidacionGaleria $request, $id)
    {
        can('modificar-fotos');

        $requestData = $request->except('foto');
        $galeria = Galeria::findOrFail($id);

        $galeria->update($requestData);

        return redirect('galeria')->with('mensaje', 'Foto actualizada con exito');
    }


    /**
     * Eliminar una ficha de personal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $request, $id)
    {
        can('eliminar-fotos');
        if ($request->ajax()) {
            $galeria = Galeria::find($id);
            if (Galeria::destroy($id)) {

                //Elimino el fichero
                Storage::disk('public')->delete('galeria/'.$galeria->foto);

                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
}
