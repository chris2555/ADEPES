<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';
    protected $primaryKey = 'id_pago';
    public $timestamps = false;

    protected $fillable = [
        'id_prestamo',
        'id_persona',
        'monto',
        'metodo_pago',
        'recibo',
        'fecha',
        'intereses',
        'creado_por',
        'abono_capital',
        'estado'
    ];


}

