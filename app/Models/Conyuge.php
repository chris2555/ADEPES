<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conyuge extends Model
{
    use HasFactory;

    protected $table = 'Conyuge'; // Nombre de la tabla
    protected $primaryKey = 'id_conyuge'; // Clave primaria
    public $timestamps = false; // Desactivar timestamps si no se usan

    protected $fillable = [
        'nombres_conyuge',
        'fecha_nacimiento_conyuge',
        'identidad_conyuge',
        'direccion_conyuge',
        'profesion_oficio_conyuge',
        'cargo_conyuge',
        'ingresos_negocio_conyuge',
        'direccion_trabajo_conyuge',
        'tipo_cliente',
        'tiempo_laborar_conyuge',
        'gastos_alimentacion_conyuge',
        'estado_credito_conyuge',
        'creado_por',
        'creado_en',
        'modificado_por',
        'modificado_en',
    ];
}
