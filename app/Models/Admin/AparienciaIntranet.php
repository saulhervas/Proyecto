<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AparienciaIntranet extends Model
{
    protected $table = 'apariencia_intranet';

    protected $fillable = ['aside','brand','navbar','card_color'];
}
