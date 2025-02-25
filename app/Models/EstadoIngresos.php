<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EstadoIngresos extends Model
{
    use HasFactory;

    protected $table = 'EstadoIngresos';
    protected $primaryKey = 'id_ingresos';
    public $timestamps = false;

    protected $fillable = [
        'id_solicitud',
        'renta_propiedades',
        'remesas',
        'aporte_conyuge',
        'ingresos_sociedad',
        'total_ingresos',
        'creado_por',
        'creado_en',
        'modificado_por',
        'modificado_en'
    ];

    protected $casts = [
        'renta_propiedades' => 'integer',
        'remesas' => 'decimal:2',
        'aporte_conyuge' => 'decimal:2',
        'ingresos_sociedad' => 'integer',
        'total_ingresos' => 'decimal:2',
        'creado_en' => 'datetime',
        'modificado_en' => 'datetime',
    ];
}
