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
        Schema::create('docentes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rol_id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('cedula')->unique();
            $table->string('telefono')->nullable();
            $table->string('correo')->unique();
            $table->string('titulo');
            $table->string('maestria')->nullable();
            $table->string('doctorado')->nullable();
            $table->string('postgrado')->nullable();
            $table->string('otro')->nullable();
            $table->string('categoria')->nullable();
            $table->string('tipo_contratacion')->nullable();
            $table->foreign('rol_id')->references('id')->on('roles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docentes');
    }
};
