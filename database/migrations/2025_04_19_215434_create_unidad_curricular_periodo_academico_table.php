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
        Schema::create('unidad_curricular_periodo_academico', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unidad_curricular_id');
            $table->unsignedBigInteger('periodo_academico_id');
            $table->unsignedBigInteger('docente_id')->nullable();
            $table->string('sede');
            $table->string('modalidad');
          
            $table->foreign('unidad_curricular_id')->references('id')->on('unidad_curricular');
            $table->foreign('periodo_academico_id')->references('id')->on('periodo_academico');
            $table->foreign('docente_id')->references('id')->on('docentes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidad_curricular_periodo_academico');
    }
};
