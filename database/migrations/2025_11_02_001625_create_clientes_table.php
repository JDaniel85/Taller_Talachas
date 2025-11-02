<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('rfc', 13)->unique();
            $table->text('direccion')->nullable();
            $table->string('correo', 100)->nullable();
            $table->number('telefono', 15)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
