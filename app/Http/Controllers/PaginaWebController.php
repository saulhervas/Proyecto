<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidacionReserva;
use App\Models\Galeria;
use App\Models\Habitacion;
use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\TipoHabitacion;
use App\Notifications\ConfirmacionReserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaginaWebController extends Controller
{
    /**
     * funcion que crea la vista index de la paguina web
     */
    public function index(){
        $fotos=[];
        $valores = ['%lifestyle%','%comida%','%index%','%habitacion%'];
        foreach(Galeria::where(function ($query) use ($valores){
            foreach($valores as $valor){
                $query->orWhere('referencia_vista','like',$valor);
            }
        })->get() as $foto){
            if(count($referencia =explode(' ',$foto->referencia_vista)) > 1 )$foto->referencia_vista = $referencia[1];
            $fotos[$foto->referencia_vista] = $foto->foto_web;
        }

        return view('pagina_web.index', compact('fotos'));
    }

    /**
     * funcion que crea la vista del listado de habitaciones
     */
    public function habitaciones(){

        $habitaciones = TipoHabitacion::with('fotos')->get();
        return view('pagina_web.habitacion.rooms-tariff', compact('habitaciones'));
    }

    /**
     * funcion que pasado un id por la url crea la vista de una habitacion en
     * particular con los datos sacados de la base de datos
     * @param int
     */
    public function habitacion($id){

        $habitacion = TipoHabitacion::findOrFail($id);
        return view('pagina_web.habitacion.room-details', compact('habitacion'));
    }

    /**
     * funcion que crea la vista del listado de servicios
     */
    public function servicios(){
        $servicios = [];
        foreach( Servicio::with(['fotos' => function ($query){
            $query->where('referencia_vista','like','%portada%');
        }])->get() as $servicio){
            if($nombre = str_replace(' ','_',$servicio->nombre)) $servicio->nombre = $nombre;
            $servicios[$servicio->nombre][] = $servicio->id;
            $servicios[$servicio->nombre][] = $servicio->fotos[0]->foto_web;
        }

        return view('pagina_web.servicios.services', compact('servicios'));
    }

    /**
     * funcion que pasado un id por la url crea la vista de un servicio
     * en particular con los datos sacados de la base de datos
     * @param int
     */
    public function servicio($id){

        $servicio = Servicio::findOrFail($id);
        $fotos = $servicio->fotos;

        if(strtoupper($servicio->nombre) == 'GIMNASIO' ) return view('pagina_web.servicios.gym-details', compact('servicio','fotos'));
        if(strtoupper($servicio->nombre) == 'RESTAURANTE' ) return view('pagina_web.servicios.restaurant-details', compact('servicio','fotos'));
        if(strtoupper($servicio->nombre) == 'SPA' ) return view('pagina_web.servicios.spa-details', compact('servicio','fotos'));
        if(strtoupper($servicio->nombre) == 'PARQUE AQUATICO' ) return view('pagina_web.servicios.park-details', compact('servicio','fotos'));

    }

    /**
     * funcion que crea la vista de la galeria donde se pueden ver diversas fotos del hotel
     */
    public function galeria(){

        $fotos = Galeria::get();
        return view('pagina_web.gallery', compact('fotos'));
    }

    /**
     * funcion que crea la vista del menu sobre nosotros
     */
    public function introduccion(){
        return view('pagina_web.introduction');
    }

    /**
     * funcion que crea la vista del menu contacto
     */
    public function contacto(){
        return view('pagina_web.contact');
    }

    /**
     * funcion que crea la vista del menu registro
     */
    public function registro(){
        $foto = Galeria::where('referencia_vista', 'login')->first();
        return view('pagina_web.seguridad.register', compact('foto'));
    }

    /**
     * funcion que crea la vista del menu login
     */
    public function login(){
        $foto = Galeria::where('referencia_vista', 'login')->first();
        return view('pagina_web.seguridad.login', compact('foto'));
    }


    /**
     * Mostrar el formulario para crear una ficha de reservas.
     *
     * @return \Illuminate\Http\Response
     */
    public function buscar_periodo(Request $request)
    {
        if(!empty($request->fecha_entrada) && !empty($request->fecha_salida)){
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
                return redirect('/web/crear-reserva')->withInput($request->all());
            }
        }
        return redirect()->back()->with('mensaje-error', 'Tienes que introducir las fechas de entrada y salida.')->withInput();
    }

    /**
     * Mostrar el formulario para crear una ficha de reservas.
     *
     * @return \Illuminate\Http\Response
     */
    public function reserva()
    {
        $cliente = Auth::user()->cliente->id;

        $fotos=[];
        $valores = ['%lifestyle%','%comida%','%index%','%habitacion%'];
        foreach(Galeria::where(function ($query) use ($valores){
            foreach($valores as $valor){
                $query->orWhere('referencia_vista','like',$valor);
            }
        })->get() as $foto){
            if(count($referencia =explode(' ',$foto->referencia_vista)) > 1 )$foto->referencia_vista = $referencia[1];
            $fotos[$foto->referencia_vista] = $foto->foto_web;
        }

        $servicios = Servicio::get()->pluck('nombre', 'id')->toArray();
        $habitaciones = TipoHabitacion::get()->pluck('nombre', 'id')->toArray();

        return view('pagina_web.reserva', compact('servicios','habitaciones','fotos','cliente'));
    }


   /**
     * Guardar una nueva ficha de reservas.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar_reserva(ValidacionReserva $request)
    {

        $data = $request->all();
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

        $reserva = Reserva::create($data);
        if(isset($data['servicio'])) $reserva->servicio()->sync($data['servicio']);

        $reserva->notify(new ConfirmacionReserva($reserva));

        return redirect('/web/crear-reserva')->with('mensaje', 'Reserva creada con exito');
    }

}
