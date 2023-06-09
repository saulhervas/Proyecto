<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidacionServicio;
use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Mostrar un listado de personal.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        can('listar-servicios');
        $datas = Servicio::get();
        return view('servicio.index', compact('datas'));
    }

    /**
     * Mostrar el formulario para crear una ficha de personal.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        can('añadir-servicios');
        return view('servicio.crear');
    }

    /**
     * Guardar una nueva ficha de personal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(ValidacionServicio $request)
    {
        can('añadir-servicios');
        Servicio::create($request->all());
        return redirect('servicio')->with('mensaje', 'Servicio creado con exito');
    }

    /**
     * Mostrar el formulario para editar una ficha de personal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        can('ver-servicios');

        $data = Servicio::findOrFail($id);

        if (!can('modificar-servicios',false)) {
            $data->only_view=1;
        }

        return view('servicio.editar', compact('data'));

    }

    /**
     * Actualizar una ficha de personal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(ValidacionServicio $request, $id)
    {
        can('modificar-servicios');

        Servicio::findOrFail($id)->update($request->all());
        
        return redirect('servicio/'.$id.'/editar')->with('mensaje', 'Servicio actualizado con exito');
    }

    /**
     * Eliminar una ficha de personal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $request, $id)
    {
        can('eliminar-servicios');
        if ($request->ajax()) {
            if (Servicio::destroy($id)) {
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
}
