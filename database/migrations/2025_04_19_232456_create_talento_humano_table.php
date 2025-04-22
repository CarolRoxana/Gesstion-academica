<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create('talento_humano', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('cedula');
            $table->string('correo');
            $table->string('telefono')->nullable();
            $table->dateTime('fecha_postulacion');
            $table->text('motivo');
            $table->string('carrera_postulacion');
            $table->string('unidad_curricular_postulacion');
            $table->string('estatus');
            $table->text('observaciones')->nullable();
            $table->dateTime('fecha_aprobacion')->nullable();
            $table->dateTime('fecha_ingreso');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('talento_humano');
    }
};
