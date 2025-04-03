<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SolicitudPrestamo extends Model
{
    use HasFactory;

    protected $table = 'SolicitudPrestamo';
    protected $primaryKey = 'id_solicitud';
    public $timestamps = false;

    protected $fillable = [
        'nombre_solicitante',
        'tipo_garantia',
        'tipo_cuota',
        'tasa',
        'plazo',
        'monto',
        'invierte_en',
        'tipo_credito',
        'estado_solicitud',
        'valor_cuota',
        'es_aval',
        'creado_por',
        'creado_en',
        'modificado_por',
        'modificado_en'
    ];

    protected $casts = [
        'tasa' => 'decimal:2',
        'monto' => 'decimal:2',
        'valor_cuota' => 'decimal:2',
        'creado_en' => 'datetime',
        'modificado_en' => 'datetime',
    ];

}
