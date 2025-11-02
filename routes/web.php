<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ClienteController,
    ServicioController,
    RefaccionController,
    FacturaController
};

// 🔹 Al iniciar el proyecto, se redirige al listado de facturas
Route::get('/', function () {
    return redirect()->route('facturas.index');
});

// 🔹 Rutas de los módulos
Route::resource('clientes', ClienteController::class);
Route::resource('servicios', ServicioController::class);
Route::resource('refacciones', RefaccionController::class);
Route::resource('facturas', FacturaController::class)->except(['edit','update']);
Route::get('facturas/{factura}/pdf', [FacturaController::class, 'generarPDF'])->name('facturas.pdf');
