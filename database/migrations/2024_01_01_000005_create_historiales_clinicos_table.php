<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historiales_clinicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained()->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained()->onDelete('cascade');
            $table->foreignId('cita_id')->nullable()->constrained()->onDelete('set null');
            $table->date('fecha');
            $table->decimal('peso', 5, 2)->nullable();
            $table->decimal('altura', 3, 2)->nullable();
            $table->decimal('presion_sistolica', 3, 0)->nullable();
            $table->decimal('presion_diastolica', 3, 0)->nullable();
            $table->decimal('temperatura', 3, 1)->nullable();
            $table->text('sintomas')->nullable();
            $table->text('diagnostico')->nullable();
            $table->text('tratamiento')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historiales_clinicos');
    }
};
