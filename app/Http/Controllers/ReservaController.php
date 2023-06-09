<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidacionReserva;
use App\Models\Cliente;
use App\Models\Habitacion;
use App\Models\Reserva;
use App\Models\Seguridad\Usuario;
use App\Models\Servicio;
use App\Models\TipoHabitacion;
use App\Notifications\ConfirmacionReserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
        /**
     * Mostrar un listado de reservas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        can('listar-reservas');
        $datas = Reserva::orderBy('fecha_entrada', 'desc')->get();

        return view('reserva.index', compact('datas'));
    }

    /**
     * Mostrar un listado de reservas filtrado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function busqueda(Request $request){

        can('listar-reservas');
        $datas = Reserva::with('cliente');

        if(!empty($request->fecha_entrada_bus)){
            $datas->where('fecha_entrada', $request->fecha_entrada_bus);
        }
        if(!empty($request->fecha_salida_bus)){
            $datas->where('fecha_salida', $request->fecha_salida_bus);
        }
        if(!empty($request->codigo_bus)){
            $datas->where('codigo', $request->codigo_bus);
        }
        if(!empty($request->nombre_bus)){
            $dni = $request->dni_bus;
            $datas->whereHas('cliente', function($query) use ($dni){
                $query->where('dni', $dni);
            });
        }

        $datas = $datas->get();
        $busqueda = $request;

        return view('reserva.index', compact('datas', 'busqueda'));
    }

    /**
     * Mostrar el formulario para crear una ficha de reservas.
     *
     * @return \Illuminate\Http\Response
     */
    public function buscar_periodo(Request $request)
    {
        can('añadir-reservas');
        $buscar = 1;

        if(!empty($request->fecha_entrada)){
            $entrada = date('Y-m-d',strtotime($request->fecha_entrada));
            $salida = date('Y-m-d',strtotime($request->fecha_salida));
            $personas = $request->num_adultos + $request->num_ninios;

            $disponibles = Habitacion::whereHas('tipo_habitacion', function($query) use ($personas){
                    $query->where('num_personas', '>=',$personas);
                })
                ->whereDoesntHave('reserva', function($query) use ($entrada, $salida){
                    $query->where('fecha_entrada', '<=',$salida)
                          ->where('fecha_salida', '>=',$entrada);
                })->count();

            if($disponibles === 0){
                return redirect()->back()->with('mensaje-error', 'No hay habitaciones libres en el periodo introducido')->withInput();
            }elseif($disponibles - $request->num_habitaciones < 0){
                return redirect()->back()->with('mensaje-error', 'No hay suficientes habitaciones libres en el periodo introducido')->withInput();
            }else{
                return redirect('reserva/crear')->withInput();
            }
        }
        return view('reserva.buscar-periodo', compact('buscar'));
    }

    /**
     * Mostrar el formulario para crear una ficha de reservas.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        can('añadir-reservas');
        $servicios = Servicio::get()->pluck('nombre', 'id')->toArray();
        $habitaciones = TipoHabitacion::get()->pluck('nombre', 'id')->toArray();
        $clientes = Cliente::get()->pluck('full_name', 'id')->toArray();
        return view('reserva.crear', compact('servicios','clientes','habitaciones'));
    }

    /**
     * Guardar una nueva ficha de reservas.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(ValidacionReserva $request)
    {
        can('añadir-reservas');
        $data = $request->all();
        // dd($data);
        $codigo = Reserva::get()->max('codigo');
        if($codigo !== null){
            $data['codigo'] = str_pad($codigo+1,5,0,STR_PAD_LEFT);
        }else{
            $data['codigo'] = '00001';
        }

        $entrada = date('Y-m-d',strtotime($data['fecha_entrada']));
        $salida = date('Y-m-d',strtotime($data['fecha_salida']));

        $habitacion = Habitacion::where('tipo_habitacion_id', $data['tipo_habitacion_id'])
        ->whereDoesntHave('reserva', function($query) use ($entrada, $salida){
            $query->where('fecha_entrada', '<',$salida)
                  ->where('fecha_salida', '>',$entrada);
        })->first();

        $data['habitacion_id'] = $habitacion->id;

        if(isset($data['nuevo_cliente'])){
            $nuevo_cliente = Cliente::create($data);
            $data['usuario'] = $data['nombre'];
            $data['password'] = $data['dni'];
            $data['re_password'] = $data['dni'];
            $usuario = Usuario::create($data);
            $usuario->roles()->sync(3);
            $usuario->cliente()->save($nuevo_cliente);
            $data['cliente_id'] = $nuevo_cliente->id;
        }

        $reserva = Reserva::create($data);
        if(isset($data['servicio'])) $reserva->servicio()->sync($data['servicio']);

        $reserva->notify(new ConfirmacionReserva($reserva));

        return redirect('reserva')->with('mensaje', 'Reserva creada con exito');
    }

    /**
     * Mostrar el formulario para editar una ficha de reservas.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        can('ver-reservas');

        $data = Reserva::with('cliente','habitacion','servicio')->findOrFail($id);
        $servicios = Servicio::get()->pluck('nombre', 'id')->toArray();
        // dd($data);
        $habitaciones = TipoHabitacion::get()->pluck('nombre', 'id')->toArray();
        $clientes = Cliente::get()->pluck('full_name', 'id')->toArray();

        if (!can('modificar-reservas',false)) {
            $data->only_view=1;
            $data->usuario->only_view=1;
        }

        return view('reserva.editar', compact('data','servicios','habitaciones','clientes'));

    }

    /**
     * Actualizar una ficha de reservas.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(ValidacionReserva $request, $id)
    {
        can('modificar-reservas');

        $reserva = Reserva::findOrFail($id);

        $data = $request->all();

        $reserva->update($data);
        $reserva->servicio()->sync($data['servicio']);

        return redirect('reserva/'.$id.'/editar')->with('mensaje', 'Reserva actualizada con exito');
    }

    /**
     * Eliminar una ficha de reservas.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $request, $id)
    {
        can('eliminar-reservas');
        if ($request->ajax()) {
            if (Reserva::destroy($id)) {

                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
}
