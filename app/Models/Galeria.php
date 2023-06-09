<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Galeria extends Model
{
    protected $table = 'galeria';

    protected $fillable = ['foto','tipo_habitacion_id','servicio_id','referencia_vista'];

    /**
     * Relación de un Personal con su usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function tipo_habitacion() {
        return $this->belongsTo(TipoHabitacion::class);
    }

    /**
     * Relación de un Personal con su usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function servicio() {
        return $this->belongsTo(Servicio::class);
    }

    public function getFotoWebAttribute(){
        return url('/storage/galeria/'.$this->attributes['foto']);
    }

    /**
     * Upload de un fichero en una ruta dada asociado a un personal.
     *
     * @param upfile $archivo
     * @param string $ruta
     * @return \Illuminate\Http\Response
     */
    public static function setArchivo($archivo, $ruta, $actual = false){

        if ($archivo) {

            //Elimino el fichero antiguo
            if ($actual) {
                Storage::disk('public')->delete($ruta.$actual);
            }

            //obtenemos el nombre del archivo
            $nomArchivo = $archivo->getClientOriginalName();

            $punto=strrpos($nomArchivo, '.');
            $nombre=substr($nomArchivo,0,$punto);
            $extension=substr($nomArchivo,$punto);
            $i=0;
            while(Storage::disk('public')->exists($ruta.$nomArchivo)) {
                $nomArchivo=$nombre."_".$i.$extension;
                $i++;
            }

            Storage::disk('public')->put($ruta.$nomArchivo,  File::get($archivo));

            return $nomArchivo;

        } else {
            return false;
        }
    }
}
