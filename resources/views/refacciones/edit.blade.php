@extends('layouts.app')
@section('title', 'Editar Refacción')
@section('content')
<h2>Editar Refacción</h2>

<form action="{{ route('refacciones.update', $refaccion) }}" method="POST" class="mt-3">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" value="{{ old('nombre', $refaccion->nombre) }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Descripción</label>
        <textarea name="descripcion" class="form-control">{{ old('descripcion', $refaccion->descripcion) }}</textarea>
    </div>
    <div class="mb-3">
        <label>Precio unitario</label>
        <input type="number" step="0.01" name="precio_unitario" value="{{ old('precio_unitario', $refaccion->precio_unitario) }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Stock</label>
        <input type="number" name="stock" value="{{ old('stock', $refaccion->stock) }}" class="form-control" required>
    </div>

    <button class="btn btn-primary">Actualizar</button>
    <a href="{{ route('refacciones.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
