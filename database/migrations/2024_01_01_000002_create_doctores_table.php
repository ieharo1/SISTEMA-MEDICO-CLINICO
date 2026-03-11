<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('especialidad_id')->constrained()->onDelete('cascade');
            $table->string('cedula')->unique();
            $table->string('telefono');
            $table->text('direccion')->nullable();
            $table->time('hora_inicio')->default('08:00:00');
            $table->time('hora_fin')->default('18:00:00');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctores');
    }
};
