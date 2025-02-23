<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'Persona';
    protected $primaryKey = 'id_persona';
    public $timestamps = false;

    protected $fillable = [
        'nombres_apellidos',
        'n_identidad',
        'fecha_nacimiento',
        'edad',
        'nacionalidad',
        'estado_civil',
        'genero',
        'tipo_persona',
        'creado_por',
        'creado_en',
        'modificado_por',
        'modificado_en',
        'email_personal',
        'email_laboral',
        'telefono_secundario'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'creado_en' => 'datetime',
        'modificado_en' => 'datetime'
    ];
}
