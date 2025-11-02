@extends('layouts.app')
@section('title', 'Servicios')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Servicios</h1>
    <a href="{{ route('servicios.create') }}" class="btn btn-primary">Nuevo Servicio</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Descripción</th>
            <th>Costo</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($servicios as $servicio)
        <tr>
            <td>{{ $servicio->id }}</td>
            <td>{{ $servicio->descripcion }}</td>
            <td>${{ number_format($servicio->costo, 2) }}</td>
            <td>
                <a href="{{ route('servicios.edit', $servicio) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('servicios.destroy', $servicio) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar servicio?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $servicios->links() }}
@endsection
