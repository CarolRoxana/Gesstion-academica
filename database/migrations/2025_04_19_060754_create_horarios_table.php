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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('docente_id');
            $table->dateTime('dia');
            $table->dateTime('hora_inicio');
            $table->dateTime('hora_finalizacion');
            $table->unsignedBigInteger('unidad_curricular_id');
            $table->string('seccion');
            $table->unsignedBigInteger('periodo_academico_id');
            $table->foreign('docente_id')->references('id')->on('docentes');
            $table->foreign('unidad_curricular_id')->references('id')->on('unidad_curricular');
            $table->foreign('periodo_academico_id')->references('id')->on('periodo_academico');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
