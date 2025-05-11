<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('unidad_curricular', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('unidad_curricular');
            $table->string('carrera');
            $table->string('semestre');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('unidad_curricular');
    }
};
