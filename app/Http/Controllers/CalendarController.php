<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Seguridad\Usuario;
use Illuminate\Http\Request;

class CalendarController extends Controller
{

    /**
     * Muestra la Vista Calendario.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function calendar($id=0){
        
        
        if ($id!=0) {
            can('ver-agenda-personal');
            $data = Usuario::with('personal')->findOrFail($id);
                
            return view('calendar', compact('data'));
        } else {
            can('ver-calendario');
            return view('calendar');
        }
    }

    /**
     * Devuelve en un JSON los eventos 
     *
     * @param int $id 
     * @return \Illuminate\Http\Response
     */
    public function index($id=0)
    {
        if ($id==0) {
            $calendar =Calendar::with('usuario')->orderBy('id')->get()->toArray();
        } else {
            $calendar =Calendar::with('usuario')->where('usuario_id', '=', $id)->orderBy('id')->get()->toArray();
        }
        
        $datas= Array();
        foreach ($calendar as $key => $evento) {
            
            $usuario = Usuario::with('roles:id,nombre','personal')->findOrFail($evento['usuario']['id']);

            //$estado=$evento["estado"];

            if ($id!=0) {
                $title=$evento["nombre"];
            } else {
                $title=$evento["nombre"]."\n".$usuario->personal->nombre." ".$usuario->personal->apellidos;
            }
            
            if ($evento['estado'] !='') $color='#f39c12';
            else $color='#f39c12';

            $datas[] = array(
                'id'   => $evento["id"],
                'title'   => $title,
                'start'   => $evento["inicio"],
                'end'   => $evento["fin"],
                'allDay'   => $evento["allDay"],
                'backgroundColor'   => $color,
                'borderColor' => $color,
                'extendedProps' => array(
                    'usuarioId' => $usuario->id,
                    'personalNom' => $usuario->personal->nombre." ".$usuario->personal->apellidos,
                    'title' => $evento["nombre"]
                ),
            );
        }

        return json_encode($datas);
    }


    /**
     * Crea nuevos eventos en el calendario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        $requestData = $request->all();

        $requestData['inicio']=date('Y-m-d H:i:s',strtotime($request->inicio));
        $requestData['fin']=date('Y-m-d H:i:s',strtotime($request->fin));

        if (isset($requestData['allDay'])) {
            $requestData['fin']=null;
        }

        $calendar=Calendar::create($requestData);

        $calendar->usuario_id=$requestData['usuario_id'];
        $calendar->save();

        return redirect()->back()->with('mensaje', 'Evento creado con exito');
    }

    /**
     * Actualiza un evento del calendario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Request $request, $id)
    {   
        if ($request->ajax()) {

            $requestData = $request->all();

            $request->inicio=str_replace('/','-', $request->inicio);
            $requestData['inicio']=date('Y-m-d H:i:s',strtotime($request->inicio));

            if ($request->fin) {
                $request->fin=str_replace('/','-', $request->fin);
                $requestData['fin']=date('Y-m-d H:i:s',strtotime($request->fin));
            } else {
                $requestData['fin']=date('Y-m-d H:i:s',strtotime ( '+1 hour' , strtotime ( $requestData['inicio']) ));
            }

            $calendar=Calendar::findOrFail($id);
            $calendar->update(array_filter($requestData));

            if (!$requestData['allDay']) {
                $calendar->allDay=0;
                $calendar->save();
            } else {
                $calendar->fin=null;
                $calendar->save();
            }

            return response()->json(['mensaje' => 'ok']);
            
        } else {
            
            $requestData = $request->all();

            

            $requestData['inicio']=date('Y-m-d H:i:s',strtotime($request->inicio));
            $requestData['fin']=date('Y-m-d H:i:s',strtotime($request->fin));

            $calendar=Calendar::findOrFail($id);
            $calendar->update($requestData);

            $calendar->usuario_id=$requestData['usuario_id'];

            if (!isset($requestData['allDay'])) {
                $calendar->allDay=0;
            } else {
                $calendar->fin=null;
            }

            $calendar->save();

            return redirect()->back()->with('mensaje', 'Evento actualizado con exito');
        }
        
        
    }

    /**
     * Elimina un evento del calendario
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $request, $id)
    {   
        if ($request->ajax()) {
            $evento = Calendar::findOrFail($id);
            $evento->delete();
            return response()->json(['mensaje' => 'ok']);
        } else {
            abort(404);
        }
    }
}
