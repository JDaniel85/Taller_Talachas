<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('factura_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('factura_id')->constrained('facturas')->onDelete('cascade');
            $table->foreignId('servicio_id')->nullable()->constrained('servicios')->onDelete('set null');
            $table->foreignId('refaccion_id')->nullable()->constrained('refacciones')->onDelete('set null');
            $table->integer('cantidad')->default(1);
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('factura_detalles');
    }
};
