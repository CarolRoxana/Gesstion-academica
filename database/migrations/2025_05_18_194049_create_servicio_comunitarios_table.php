<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servicio_comunitarios', function (Blueprint $table) {
            $table->id();
            // Primer estudiante (requerido)
            $table->string('nombre_estudiante');
            $table->string('apellido_estudiante');
            $table->string('cedula');
            $table->string('carrera');

            // Segundo estudiante (opcional)
            $table->string('nombre_estudiante2')->nullable();
            $table->string('apellido_estudiante2')->nullable();
            $table->string('cedula2')->nullable();
            $table->string('carrera2')->nullable();

            // Tercer estudiante (opcional)
            $table->string('nombre_estudiante3')->nullable();
            $table->string('apellido_estudiante3')->nullable();
            $table->string('cedula3')->nullable();
            $table->string('carrera3')->nullable();

            // Cuarto estudiante (opcional)
            $table->string('nombre_estudiante4')->nullable();
            $table->string('apellido_estudiante4')->nullable();
            $table->string('cedula4')->nullable();
            $table->string('carrera4')->nullable();

            // Quinto estudiante (opcional)
            $table->string('nombre_estudiante5')->nullable();
            $table->string('apellido_estudiante5')->nullable();
            $table->string('cedula5')->nullable();
            $table->string('carrera5')->nullable();
            
            $table->string('titulo_servicio');
            $table->string('trabajo_servicio');
            $table->unsignedBigInteger('docente_id');
            $table->foreign('docente_id')->references('id')->on('docentes');
            $table->string('estatus');
            $table->date('fecha_ingreso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicio_comunitarios');
    }
};
