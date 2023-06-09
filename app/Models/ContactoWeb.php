<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactoWeb extends Model
{
    protected $table = 'contacto_web';

    protected $fillable = ['nombre','email','telefono','mensaje'];
}
