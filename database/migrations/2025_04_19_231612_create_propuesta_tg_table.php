<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create('propuesta_tg', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_tesista');
            $table->string('apellido_tesista');
            $table->string('cedula');
            $table->string('carrera');

            // Segundo tesista (opcional)
            $table->string('nombre_tesista2')->nullable();
            $table->string('apellido_tesista2')->nullable();
            $table->string('cedula2')->nullable();
            $table->string('carrera2')->nullable();
            
            // Tercer tesista (opcional)
            $table->string('nombre_tesista3')->nullable();
            $table->string('apellido_tesista3')->nullable();
            $table->string('cedula3')->nullable();
            $table->string('carrera3')->nullable();

            $table->string('titulo_propuesta');
            $table->string('propuesta');
            $table->unsignedBigInteger('docente_id');
            $table->foreign('docente_id')->references('id')->on('docentes');
            $table->string('estatus');
            $table->dateTime('fecha_ingreso');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('propuesta_tg');
    }
};
