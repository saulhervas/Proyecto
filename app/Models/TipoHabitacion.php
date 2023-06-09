<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoHabitacion extends Model
{
    protected $table = 'tipo_habitacion';

    protected $fillable = ['nombre','num_personas','num_camas','descripcion','tamanio','precio'];

    /**
     * Relación de un tipo habitacion con sus fotos.
     *
     * @return \Illuminate\Http\Response
     */
    public function fotos() {
        return $this->hasMany(Galeria::class);
    }

}
