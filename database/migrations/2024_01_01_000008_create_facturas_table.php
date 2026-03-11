<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained()->onDelete('cascade');
            $table->foreignId('cita_id')->nullable()->constrained()->onDelete('set null');
            $table->string('numero_factura')->unique();
            $table->date('fecha');
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('iva', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->text('descripcion')->nullable();
            $table->enum('estado', ['Pendiente', 'Pagada', 'Cancelada'])->default('Pendiente');
            $table->timestamps();
        });

        Schema::create('factura_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('factura_id')->constrained()->onDelete('cascade');
            $table->string('descripcion');
            $table->integer('cantidad')->default(1);
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('factura_items');
        Schema::dropIfExists('facturas');
    }
};
