<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('cedula')->unique();
            $table->date('fecha_nacimiento');
            $table->enum('sexo', ['Masculino', 'Femenino']);
            $table->string('telefono');
            $table->string('email')->nullable();
            $table->text('direccion')->nullable();
            $table->string('tipo_sangre')->nullable();
            $table->text('alergias')->nullable();
            $table->text('enfermedades_cronicas')->nullable();
            $table->string('contacto_emergencia')->nullable();
            $table->string('telefono_emergencia')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
