<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Reserva extends Model
{
    use Notifiable;

    protected $table = 'reserva';

    protected $fillable = ['codigo','habitacion_id','cliente_id','fecha_entrada','fecha_salida','num_adultos','num_ninios','num_habitaciones'];

    protected $appends = ['num_noches'];

    /**
     * Relación de servicio con reserva.
     *
     * @return \Illuminate\Http\Response
     */
    public function servicio() {
        return $this->belongsToMany(Servicio::class, 'servicio_reserva', 'reserva_id', 'servicio_id');
    }

    /**
     * Relación de habitacion con reserva.
     *
     * @return \Illuminate\Http\Response
     */
    public function habitacion() {
        return $this->belongsTo(Habitacion::class);
    }

    /**
     * Relación de servicio con reserva.
     *
     * @return \Illuminate\Http\Response
     */
    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Devuelve la fecha entrada formateada en Español.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFechaEntradaAttribute(){
        return date('d-m-Y',strtotime($this->attributes['fecha_entrada']));
    }

    /**
     * Devuelve la fecha salida formateada en Español.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFechaSalidaAttribute(){
        return date('d-m-Y',strtotime($this->attributes['fecha_salida']));
    }

    /**
     * Establece la fecha entrada formateada en Ingles.
     *
     * @return \Illuminate\Http\Response
     */
    public function setFechaEntradaAttribute($value){
        $this->attributes['fecha_entrada'] = date('Y-m-d',strtotime($value));
    }

    /**
     * Establece la fecha salida formateada en Ingles.
     *
     * @return \Illuminate\Http\Response
     */
    public function setFechaSalidaAttribute($value){
        $this->attributes['fecha_salida'] = date('Y-m-d',strtotime($value));
    }

    /**
     * Devuelve la fecha salida formateada en Español.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNumNochesAttribute(){

        $entrada = new Carbon($this->attributes['fecha_entrada']);
        $salida = new Carbon($this->attributes['fecha_salida']);

        $num_dias = $entrada->diff($salida);

        return $num_dias->format('%a');
    }

    /**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForMail($notification) {

        if ($this->cliente->email!==NULL) {

            return $this->cliente->email;

        }
    }

}
