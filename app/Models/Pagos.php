<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pagos extends Model
{
    use HasFactory;

    protected $table = 'RelacionSolicitudPersona';
    protected $primaryKey = 'id_relacion';
    public $timestamps = false;

    protected $fillable = [
        'id_prestamo',
        'id_persona',
        'metodo_pago',
        'recibo',
        'monto',
        'fecha',
        'creado_por',
        'modificado_por',
        'modificado_en',
        'intereses'
    ];

    protected $dates = ['creado_en', 'modificado_en'];
}
