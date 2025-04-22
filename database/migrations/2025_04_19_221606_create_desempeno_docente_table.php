<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('desempeno_docente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('docente_id');
            $table->unsignedBigInteger('unidad_curricular_periodo_academico_id');
            $table->integer('puntualidad');
            $table->string('calidad_ensenanza');
            $table->text('observaciones')->nullable();
            $table->string('participacion_proyectos');
            $table->string('cumplimiento_administrativo');
            $table->string('evaluado_por');
            $table->dateTime('fecha_evaluacion');
            $table->foreign('docente_id')->references('id')->on('docentes');
            $table->foreign('unidad_curricular_periodo_academico_id')->references('id')->on('unidad_curricular_periodo_academico');
            $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('desempeno_docente');
    }
};
