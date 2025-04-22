<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create('licencia_docente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('nombre_curso');
            $table->string('institucion');
            $table->string('tipo_curso');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->string('estatus');
            $table->text('justificacion')->nullable();
            $table->dateTime('fecha_aprobacion')->nullable();
            $table->foreign('id_user')->references('id')->on('users');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('licencia_docente');
    }
};
