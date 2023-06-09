<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidacionHabitacion;
use App\Models\Habitacion;
use App\Models\TipoHabitacion;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{
    /**
     * Mostrar un listado de habitacines.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        can('listar-habitacion');
        $datas = Habitacion::get();

        return view('habitacion.index', compact('datas'));
    }

    /**
     * Mostrar el formulario para crear una habitación.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        can('añadir-habitacion');
        $tipos = TipoHabitacion::get()->pluck('nombre', 'id')->toArray();
        return view('habitacion.crear', compact('tipos'));
    }

    /**
     * Guardar una nueva habitación.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(ValidacionHabitacion $request)
    {
        can('añadir-habitacion');

        Habitacion::create($request->all());

        return redirect('habitacion')->with('mensaje', 'Habitación creada con exito');
    }

    /**
     * Mostrar el formulario para editar una habitación.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        can('ver-habitacion');

        $data = Habitacion::findOrFail($id);
        $tipos = TipoHabitacion::get()->pluck('nombre', 'id')->toArray();

        if (!can('modificar-habitacion',false)) {
            $data->only_view=1;
            $data->usuario->only_view=1;
        }

        return view('habitacion.editar', compact('data','tipos'));

    }

    /**
     * Actualizar una habitación.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(ValidacionHabitacion $request, $id)
    {
        can('modificar-habitacion');

        $habitacion = Habitacion::findOrFail($id);
        $data = $request->all();

        if(!isset($data['disponible'])) $data['disponible'] = 0;

        $habitacion->update($data);

        return redirect('habitacion/'.$id.'/editar')->with('mensaje', 'Habitación actualizada con exito');
    }

    /**
     * Eliminar una habitación.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $request, $id)
    {
        can('eliminar-habitacion');
        if ($request->ajax()) {
            if (Habitacion::destroy($id)) {

                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
}
