@extends('layouts.app')
@section('title', 'Nuevo Servicio')
@section('content')
<h2>Registrar nuevo servicio</h2>

<form action="{{ route('servicios.store') }}" method="POST" class="mt-3">
    @csrf
    <div class="mb-3">
        <label>Descripción del servicio</label>
        <input type="text" name="descripcion" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Costo</label>
        <input type="number" step="0.01" name="costo" class="form-control" required>
    </div>
    <button class="btn btn-success">Guardar</button>
    <a href="{{ route('servicios.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
