<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Suscripciones extends Notification
{
    use Queueable;

    protected $sub;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($sub)
    {
        $this->sub = $sub;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if($this->sub->activo == 1){
            return (new MailMessage)
                        ->line('Gracias por suscribirse a nuestro boletín de noticas!.')
                        ->action('Si desea cancelar su suscripción haga click en el siguiente enlace ', url(route('cancelar_suscripcion', ['id' => $this->sub->id])));

        }else{
            return (new MailMessage)
                        ->line('Su suscripción al boletín de noticias ha sido cancelada con exito.');
        }

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
