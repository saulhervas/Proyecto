<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Suscripcion extends Model
{
    use Notifiable;

    protected $table = 'suscripcion';

    protected $fillable = ['email','activo'];

    /**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForMail($notification) {
        return $this->attributes['email'];
    }
}
