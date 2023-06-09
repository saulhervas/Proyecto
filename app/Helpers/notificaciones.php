<?php

use App\Models\Personal;
use Illuminate\Database\Eloquent\Builder;

if (!function_exists('notificaciones')) {
    function notificaciones()
    {   
        $notificaciones= Array();
        
        if (can('notif-fotos',false)) {
            $personal = Personal::where('foto', '=', null)->get();

            foreach ($personal as $key => $ficha) {

                $notificacion= Array();
                $notificacion['url']="/personal/$ficha->id/editar";
                $notificacion['icono']='fa-image';
                $notificacion['mensaje']=$ficha->nombre." ".$ficha->apellidos." no tiene foto.";
                $notificacion['fecha']=date('d-m-Y H:i:s', strtotime($ficha->updated_at));

                $notificaciones[]= $notificacion;
            }
        }

        if (count($notificaciones)>0) return $notificaciones;
        return false;
    }
}