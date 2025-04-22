<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('lineamiento_docente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('docente_id');
            $table->dateTime('fecha_supervision');
            $table->string('resumen');
            $table->string('cumple_lineamientos');
            $table->text('observaciones')->nullable();
            $table->unsignedBigInteger('periodo_academico_id');
            $table->foreign('docente_id')->references('id')->on('docentes');
            $table->foreign('periodo_academico_id')->references('id')->on('periodo_academico');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lineamiento_docente');
    }
};
