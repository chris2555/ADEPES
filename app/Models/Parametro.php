<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Parametro
 *
 * @property $id_parametros
 * @property $tipo_usuario
 * @property $clave
 * @property $nombre_usuario
 * @property $creado_en
 * @property $actualizado_en
 * @property $intento_ingreso
 * @property $vencimiento_usuario
 * @property $descripcion
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Parametro extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_parametros', 'tipo_usuario', 'clave', 'nombre_usuario', 'creado_en', 'actualizado_en', 'intento_ingreso', 'vencimiento_usuario', 'descripcion'];


}
