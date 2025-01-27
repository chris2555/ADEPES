<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('solicitud_prestamos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('identidad')->unique();
        $table->decimal('monto', 10, 2);
        $table->integer('plazo');
        $table->decimal('tasa', 5, 2);
        $table->string('actividad');
        $table->string('direccion');
        $table->string('telefono');
        $table->string('celular')->nullable();
        $table->string('estado_civil');
        $table->integer('dependientes');
        $table->string('genero');
        $table->string('tipo_credito');
        $table->decimal('ingreso', 10, 2);
        $table->decimal('gasto_alimentacion', 10, 2);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_prestamos');
    }
};
