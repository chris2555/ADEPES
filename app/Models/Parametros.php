<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class parametros extends Model
{
    use HasFactory;

    protected $table = 'Parametros';
    protected $primaryKey = 'id_parametros';
    public $timestamps = false;

    protected $fillable = [
        'id_parametro',
        'tipo_usuario',
        'clave',
        'nombre_usuario',
        'creado_en',
        'actualizado_en',
        'intento_ingreso',
        'vencimiento_usuario',
        'descripcion'
        
    ];

    protected $dates = ['creado_en', 'modificado_en'];
}
