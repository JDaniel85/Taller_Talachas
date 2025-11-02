@extends('layouts.app')
@section('title', 'Editar Cliente')
@section('content')
<h2>Editar Cliente</h2>

<form action="{{ route('clientes.update', $cliente) }}" method="POST" class="mt-3">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nombre completo</label>
        <input type="text" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>RFC</label>
        <input type="text" name="rfc" value="{{ old('rfc', $cliente->rfc) }}" class="form-control" required maxlength="13">
    </div>
    <div class="mb-3">
        <label>Dirección</label>
        <textarea name="direccion" class="form-control">{{ old('direccion', $cliente->direccion) }}</textarea>
    </div>
    <div class="mb-3">
        <label>Correo electrónico</label>
        <input type="email" name="correo" value="{{ old('correo', $cliente->correo) }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Teléfono</label>
        <input type="number" name="telefono" value="{{ old('telefono', $cliente->telefono) }}" class="form-control"
        oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10);">
    </div>

    <button class="btn btn-primary">Actualizar</button>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
