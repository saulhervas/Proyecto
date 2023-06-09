<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'evento';

    protected $fillable = ['nombre', 'inicio', 'fin', 'allDay', 'estado'];

    /**
     * Relación de un Calendario con el Usuario al que pertenece..
     *
     * @return \Illuminate\Http\Response
     */
    public function usuario() {
        return $this->belongsTo('App\Models\Seguridad\Usuario');
    }
}
