<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidacionTipoHabitacion;
use App\Models\TipoHabitacion;
use Illuminate\Http\Request;

class TipoHabitacionController extends Controller
{
    /**
     * Mostrar un listado de personal.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        can('listar-tipo-habitacion');
        $datas = TipoHabitacion::get();

        return view('tipo-habitacion.index', compact('datas'));
    }

    /**
     * Mostrar el formulario para crear una ficha de personal.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        can('añadir-tipo-habitacion');
        return view('tipo-habitacion.crear');
    }

    /**
     * Guardar una nueva ficha de personal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(ValidacionTipoHabitacion $request)
    {
        can('añadir-tipo-habitacion');
        TipoHabitacion::create($request->all());

        return redirect('tipo-habitacion')->with('mensaje', 'Tipo habitacion creada con exito');
    }

    /**
     * Mostrar el formulario para editar una ficha de personal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        can('ver-tipo-habitacion');
        $data = TipoHabitacion::findOrFail($id);

        if (!can('modificar-tipo-habitacion',false)) {
            $data->only_view=1;
            $data->usuario->only_view=1;
        }

        return view('tipo-habitacion.editar', compact('data'));

    }

    /**
     * Actualizar una ficha de personal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(ValidacionTipoHabitacion $request, $id)
    {
        can('modificar-tipo-habitacion');

        $habitacion = TipoHabitacion::findOrFail($id);
        $data = $request->except('foto');
        $habitacion->update($data);

        return redirect('tipo-habitacion/'.$id.'/editar')->with('mensaje', 'Tipo habitacion actualizada con exito');
    }

    /**
     * Eliminar una ficha de personal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $request, $id)
    {
        can('eliminar-tipo-habitacion');
        if ($request->ajax()) {
            if (TipoHabitacion::destroy($id)) {
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
}
