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
        Schema::create('temario_docente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unidad_curricular_periodo_academico_id');
            $table->text('contenido');
            $table->date('fecha_agregado');
            $table->foreign('unidad_curricular_periodo_academico_id')->references('id')->on('unidad_curricular_periodo_academico');
            $table->unsignedBigInteger('docente_id');
            $table->foreign('docente_id')->references('id')->on('docentes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temario_docente');
    }
};
