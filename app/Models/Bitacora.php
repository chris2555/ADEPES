<?php

// app/Models/Bitacora.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bitacora extends Model
{
    use HasFactory;

    protected $table = 'Bitacora';
    protected $primaryKey = 'id_bitacora';
    public $timestamps = false;

    protected $fillable = [
        'id', // FK a users
        'accion',
        'modulo',
        'fecha_hora',
    ];

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}

