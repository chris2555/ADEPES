<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudPrestamo extends Model
{
    use HasFactory;

    // Tabla asociada
    protected $table = 'SolicitudPrestamo';

    // Clave primaria
    protected $primaryKey = 'id_solicitud';

    // Deshabilitar timestamps automáticos si ya usas columnas personalizadas
    public $timestamps = false;

    // Tipos de datos que pueden asignarse en masa
    protected $fillable = [
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
        'modificado_por'
    ];

    // Fechas para convertir a instancias de Carbon
    protected $dates = ['creado_en', 'modificado_en'];
}
