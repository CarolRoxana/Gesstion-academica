<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create('propuesta_tp', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_pasante');
            $table->string('apellido_pasante');
            $table->string('cedula');
            $table->string('carrera');
            $table->string('titulo_propuesta');
            $table->string('plan_trabajo');
            $table->unsignedBigInteger('docente_id');
            $table->foreign('docente_id')->references('id')->on('docentes');
            $table->string('estatus');
            $table->dateTime('fecha_ingreso');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('propuesta_tp');
    }
};
