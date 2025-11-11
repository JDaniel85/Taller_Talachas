@extends('layouts.app')
@section('title', 'Nuevo Cliente')
@section('content')
<h2>Registrar nuevo cliente</h2>

<form action="{{ route('clientes.store') }}" method="POST" class="mt-3">
    @csrf
    <div class="mb-3">
        <label>Nombre completo</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>RFC</label>
        <input type="text" name="rfc" class="form-control" required maxlength="13">
    </div>
    <div class="mb-3">
        <label>Dirección</label>
        <textarea name="direccion" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label>Correo electrónico</label>
        <input type="email" name="correo" class="form-control">
    </div>
    <div class="mb-3">
        <label>Teléfono</label>
        <input type="tel" name="telefono" maxlength="10" class="form-control">
    </div>
    <button class="btn btn-success">Guardar</button>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
