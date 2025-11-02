@extends('layouts.app')

@section('content')
<h2>Crear Factura</h2>

<form action="{{ route('facturas.store') }}" method="POST">
@csrf
<div class="mb-3">
  <label>Cliente:</label>
  <select name="cliente_id" class="form-control" required>
    <option value="">Seleccione cliente</option>
    @foreach($clientes as $cliente)
      <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
    @endforeach
  </select>
</div>

<h4>Servicios</h4>
@foreach($servicios as $servicio)
  <div>
    <input type="checkbox" name="items[{{ $loop->index }}][servicio_id]" value="{{ $servicio->id }}">
    {{ $servicio->descripcion }} - ${{ $servicio->costo }}
    <input type="hidden" name="items[{{ $loop->index }}][precio_unitario]" value="{{ $servicio->costo }}">
    <input type="hidden" name="items[{{ $loop->index }}][cantidad]" value="1">
  </div>
@endforeach

<h4>Refacciones</h4>
@foreach($refacciones as $ref)
  <div>
    <input type="checkbox" name="items[{{ $loop->iteration + 100 }}][refaccion_id]" value="{{ $ref->id }}">
    {{ $ref->nombre }} - ${{ $ref->precio_unitario }}
    <input type="hidden" name="items[{{ $loop->iteration + 100 }}][precio_unitario]" value="{{ $ref->precio_unitario }}">
    <input type="hidden" name="items[{{ $loop->iteration + 100 }}][cantidad]" value="1">
  </div>
@endforeach

<button type="submit" class="btn btn-success mt-3">Guardar Factura</button>
</form>
@endsection
 