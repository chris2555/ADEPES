<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RelacionSolicitudPersona extends Model
{
    use HasFactory;

    protected $table = 'RelacionSolicitudPersona';
    protected $primaryKey = 'id_relacion';
    public $timestamps = false;

    protected $fillable = [
        'id_solicitud',
        'id_persona',
        'id_conyuge',
        'id_ingresos',
        'id_aval1',
        'id_aval2',
        'id_aval3',
        'creado_por',
        'creado_en',
        'modificado_por',
        'modificado_en'
    ];

    protected $dates = ['creado_en', 'modificado_en'];
}
