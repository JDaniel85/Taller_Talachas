@extends('layouts.app')
@section('title', 'Nueva Refacción')
@section('content')
<h2>Registrar nueva refacción</h2>

<form action="{{ route('refacciones.store') }}" method="POST" class="mt-3">
    @csrf
    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Descripción</label>
        <textarea name="descripcion" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label>Precio unitario</label>
        <input type="number" step="0.01" name="precio_unitario" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Stock inicial</label>
        <input type="number" name="stock" class="form-control" required min="0">
    </div>
    <button class="btn btn-success">Guardar</button>
    <a href="{{ route('refacciones.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
