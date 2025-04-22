<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('incidentes_estudiantiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('docente_id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('cedula');
            $table->string('carrera');
            $table->string('semestre');
            $table->string('incidente');
            $table->text('descripcion')->nullable();
            $table->dateTime('fecha_incidente');
            $table->foreign('docente_id')->references('id')->on('docentes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidentes_estudiantiles');
    }
};
