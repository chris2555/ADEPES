<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'parametros';

    // Indica que la clave primaria se llama 'id'
    protected $primaryKey = 'id';

    // Indica que la clave primaria NO es autoincremental
    public $incrementing = false;

    // Indica que el tipo de la clave primaria es string
    protected $keyType = 'string';

    // Especifica los campos que se pueden asignar masivamente
    protected $fillable = [
        'id',
        'valor',
        'descripcion',
    ];
}