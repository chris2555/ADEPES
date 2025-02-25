<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EstadoEgresos extends Model
{
    use HasFactory;

    protected $table = 'EstadoEgresos';
    protected $primaryKey = 'id_egresos';
    public $timestamps = false;

    protected $fillable = [
        'id_solicitud',
        'central_riesgo',
        'otro_egresos',
        'total_egresos',
        'creado_por',
        'creado_en',
        'modificado_por',
        'modificado_en'
    ];

    protected $casts = [
        'central_riesgo' => 'decimal:2',
        'otro_egresos' => 'decimal:2',
        'total_egresos' => 'decimal:2',
        'creado_en' => 'datetime',
        'modificado_en' => 'datetime',
    ];

}
