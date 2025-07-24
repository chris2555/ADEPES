<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; // Importa Carbon si vas a usar mutadores personalizados

class Cuota extends Model
{
    use HasFactory;

    protected $table = 'amortizacion'; // Nombre de la tabla real
    protected $primaryKey = 'id_amortizacion'; // Clave primaria

    public $timestamps = false; // Si la tabla no tiene created_at y updated_at

    protected $fillable = [
        'id_prestamo',
        'id_persona',
        'fecha', // La columna 'fecha'
        'numero_cuota',
        'valor_cuota',
        'valor_intereses',
        'valor_capital',
        'saldo_capital',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha' => 'date', // Laravel automáticamente convertirá 'fecha' a un objeto Carbon
                           // y lo formateará a YYYY-MM-DD si lo serializas a JSON.
                           // También puedes usar 'datetime' si la columna incluye hora.
    ];

    /*
    // Opcional: Si quieres un formato de fecha específico al acceder a él (ej. 'd/m/Y')
    // y sobrescribir el comportamiento predeterminado de 'date' cast.
    public function getFechaAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    // Opcional: Si necesitas guardar la fecha en un formato específico
    public function setFechaAttribute($value)
    {
        $this->attributes['fecha'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString(); // Guarda como YYYY-MM-DD
    }
    */
}