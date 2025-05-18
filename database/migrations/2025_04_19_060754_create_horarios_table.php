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
            $table->string('dia');
            $table->time('hora_inicio');
            $table->time('hora_finalizacion');
            $table->unsignedBigInteger('unidad_curricular_id');
            $table->unsignedBigInteger('periodo_academico_id');
            $table->foreign('docente_id')->references('id')->on('docentes');
            $table->foreignId('seccion_id')->constrained()->onDelete('cascade');
            $table->foreign('unidad_curricular_id')->references('id')->on('unidad_curricular');
            $table->foreign('periodo_academico_id')->references('id')->on('periodo_academico');
            $table->string('sede')->nullable(false);
            $table->unsignedTinyInteger('aula_id');
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
