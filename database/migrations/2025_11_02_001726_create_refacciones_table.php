<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('refacciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->decimal('precio_unitario', 10, 2);
            $table->integer('stock')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('refacciones');
    }
};
