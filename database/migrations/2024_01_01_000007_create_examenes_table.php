<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('examenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained()->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained()->onDelete('cascade');
            $table->foreignId('historial_clinico_id')->nullable()->constrained()->onDelete('set null');
            $table->string('tipo');
            $table->text('descripcion')->nullable();
            $table->date('fecha_solicitud');
            $table->date('fecha_resultado')->nullable();
            $table->text('resultados')->nullable();
            $table->text('observaciones')->nullable();
            $table->enum('estado', ['Solicitado', 'En Proceso', 'Completado', 'Cancelado'])->default('Solicitado');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('examenes');
    }
};
