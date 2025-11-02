@extends('layouts.app')
@section('title', 'Refacciones')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Refacciones</h1>
    <a href="{{ route('refacciones.create') }}" class="btn btn-primary">Nueva Refacción</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($refacciones as $refaccion)
        <tr>
            <td>{{ $refaccion->id }}</td>
            <td>{{ $refaccion->nombre }}</td>
            <td>${{ number_format($refaccion->precio_unitario, 2) }}</td>
            <td>{{ $refaccion->stock }}</td>
            <td>
                <a href="{{ route('refacciones.edit', $refaccion) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('refacciones.destroy', $refaccion) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar refacción?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $refacciones->links() }}
@endsection
