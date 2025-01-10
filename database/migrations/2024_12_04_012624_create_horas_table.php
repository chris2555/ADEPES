<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hours', function (Blueprint $table) {
            $table->id('id'); // ID de la tabla
            $table->string('titulo'); // Título del evento o actividad
            $table->string('ambito'); // Ámbito del evento
            $table->string('archivo'); // Nombre del archivo relacionado
            $table->integer('cantidad'); // Cantidad (por ejemplo, horas)
            $table->timestamps(); // Campos created_at y updated_at
        });
    }


    // Inserción de datos iniciales
   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hours');
    }
};
