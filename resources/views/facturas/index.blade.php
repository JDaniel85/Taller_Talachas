@extends('layouts.app')
@section('title','Facturas Emitidas')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="text-primary fw-bold">📄 Facturas Emitidas</h1>
  <a href="{{ route('facturas.create') }}" class="btn btn-primary btn-lg shadow">+ Nueva Factura</a>
</div>

<div class="card-custom">
  <table class="table table-hover align-middle">
    <thead class="table-primary">
      <tr>
        <th>#</th>
        <th>Cliente</th>
        <th>Total</th>
        <th>Fecha</th>
        <th>Estatus</th>
        <th class="text-center">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @forelse($facturas as $f)
      <tr>
        <td>{{ $f->id }}</td>
        <td>{{ $f->cliente->nombre ?? '-' }}</td>
        <td><strong>${{ number_format($f->total,2) }}</strong></td>
        <td>{{ $f->created_at->format('d/m/Y H:i') }}</td>
        <td>
          <span class="badge bg-success">{{ ucfirst($f->estatus) }}</span>
        </td>
        <td class="text-center">
          <a href="{{ route('facturas.show', $f) }}" class="btn btn-sm btn-info text-white">Ver</a>
          <a href="{{ route('facturas.print', $f->id) }}" class="btn btn-sm btn-primary">🖨️ Imprimir</a>
          <a href="{{ route('facturas.download', $f->id) }}" class="btn btn-sm btn-outline-dark">⬇️ Descargar</a>
          <form action="{{ route('facturas.destroy', $f) }}" method="POST" style="display:inline-block">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar factura?')">🗑️</button>
          </form>
        </td>
      </tr>
      @empty
      <tr><td colspan="6" class="text-center text-muted">No hay facturas registradas.</td></tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-3">
    {{ $facturas->links() }}
  </div>
</div>

@endsection
