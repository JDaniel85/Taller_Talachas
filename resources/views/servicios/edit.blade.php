@extends('layouts.app')
@section('title', 'Editar Servicio')
@section('content')
<h2>Editar Servicio</h2>

<form action="{{ route('servicios.update', $servicio) }}" method="POST" class="mt-3">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Descripción del servicio</label>
        <input type="text" name="descripcion" value="{{ old('descripcion', $servicio->descripcion) }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Costo</label>
        <input type="number" step="0.01" name="costo" value="{{ old('costo', $servicio->costo) }}" class="form-control" required>
    </div>

    <button class="btn btn-primary">Actualizar</button>
    <a href="{{ route('servicios.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
