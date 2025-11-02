@extends('layouts.app')
@section('title', 'Clientes')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Clientes</h1>
    <a href="{{ route('clientes.create') }}" class="btn btn-primary">Nuevo Cliente</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>RFC</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($clientes as $cliente)
        <tr>
            <td>{{ $cliente->id }}</td>
            <td>{{ $cliente->nombre }}</td>
            <td>{{ $cliente->rfc }}</td>
            <td>{{ $cliente->telefono }}</td>
            <td>{{ $cliente->correo }}</td>
            <td>
                <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar cliente?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $clientes->links() }}
@endsection
