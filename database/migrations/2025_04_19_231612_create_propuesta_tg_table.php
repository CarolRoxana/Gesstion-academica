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
