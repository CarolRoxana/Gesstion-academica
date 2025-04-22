<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create('curso_inter_semestral', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('docente_id');
            $table->string('nombre_curso');
            $table->text('descripcion');
            $table->string('modalidad');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->integer('cupos_max');
            $table->string('estatus');
            $table->string('exponente')->nullable();
            $table->foreign('docente_id')->references('id')->on('docentes');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('curso_inter_semestral');
    }
};
