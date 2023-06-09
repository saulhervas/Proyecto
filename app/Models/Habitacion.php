<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    protected $table = 'habitacion';

    protected $fillable = ['tipo_habitacion_id','numero','disponible'];

    protected $appends = ['disponibles','nombre'];

    /**
     * Relación de un Personal con su usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function tipo_habitacion() {
        return $this->belongsTo(TipoHabitacion::class);
    }

    /**
     * Relación de habitacion con reserva.
     *
     * @return \Illuminate\Http\Response
     */
    public function reserva() {
        return $this->hasMany(Reserva::class);
    }

    /**
     * Relación de un Personal con su usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDisponiblesAttribute() {
        return $this->where('disponible', 1)->count();
    }

    /**
     * Relación de un Personal con su usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function getHabitacionAttribute() {
        return $this->tipo_habitacion->nombre;
    }

    /**
     * Relación de un Personal con su usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDisponibleAttribute() {
        if($this->attributes['disponible'] == 1){
            return 'Disponible';
        }else{
            return 'Ocupada';
        }
    }

    /**
     * Relación de un Personal con su usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNombreAttribute() {
        return $this->tipo_habitacion->nombre;
    }


}
