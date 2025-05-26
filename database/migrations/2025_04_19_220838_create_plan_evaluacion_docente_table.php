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
        Schema::create('plan_evaluacion_docente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unidad_curricular_periodo_academico_id');
            $table->integer('porcentaje_evaluacion');
            $table->date('fecha_evaluacion');
            $table->string('tipo_evaluacion');
            $table->foreign('unidad_curricular_periodo_academico_id', 'uc_pa')
            ->references('id')
            ->on('unidad_curricular_periodo_academico');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_evaluacion_docente');
    }
};
