<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicio';

    protected $fillable = ['nombre', 'precio','descripcion'];

    /**
     * Relación de servicio con reserva.
     *
     * @return \Illuminate\Http\Response
     */
    public function reserva() {
        return $this->belongsToMany(Reserva::class, 'servicio_reserva', 'servicio_id', 'reserva_id');
    }

    /**
     * Relación de un tipo habitacion con sus fotos.
     *
     * @return \Illuminate\Http\Response
     */
    public function fotos() {
        return $this->hasMany(Galeria::class);
    }
}
