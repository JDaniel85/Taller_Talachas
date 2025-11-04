@extends('layouts.app')
@section('title','Nueva Factura')
@section('content')

<div class="card-custom">
  <h2 class="text-primary fw-bold mb-3">🧾 Generar Nueva Factura</h2>

  <form action="{{ route('facturas.store') }}" method="POST" id="facturaForm">
    @csrf

    <div class="mb-3">
      <label class="fw-semibold">Cliente</label>
      <select name="cliente_id" class="form-select" required>
        <option value="">-- Seleccione un cliente --</option>
        @foreach($clientes as $c)
          <option value="{{ $c->id }}">{{ $c->nombre }} ({{ $c->rfc }})</option>
        @endforeach
      </select>
    </div>

    <div class="border p-3 rounded mb-3" style="background-color:#e7f1ff">
      <h5 class="fw-bold text-primary">Agregar Conceptos</h5>

      <div id="items"></div>

      <div class="row mt-3">
        <div class="col-md-6">
          <label>Servicios disponibles</label>
          <select id="servicio_select" class="form-select">
            <option value="">-- seleccionar --</option>
            @foreach($servicios as $s)
              <option value="{{ $s->id }}" data-precio="{{ $s->costo }}">{{ $s->descripcion }} — ${{ $s->costo }}</option>
            @endforeach
          </select>
          <button type="button" class="btn btn-outline-primary mt-2" onclick="addServicio()">Agregar servicio</button>
        </div>

        <div class="col-md-6">
          <label>Refacciones disponibles</label>
          <select id="refaccion_select" class="form-select">
            <option value="">-- seleccionar --</option>
            @foreach($refacciones as $r)
              <option value="{{ $r->id }}" data-precio="{{ $r->precio_unitario }}" data-stock="{{ $r->stock }}">{{ $r->nombre }} — ${{ $r->precio_unitario }} (stock: {{ $r->stock }})</option>
            @endforeach
          </select>
          <div class="input-group mt-2">
            <input id="ref_cant" type="number" min="1" value="1" class="form-control" style="max-width:120px">
            <button type="button" class="btn btn-outline-primary" onclick="addRefaccion()">Agregar refacción</button>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-light p-3 rounded text-end">
      <h5 id="resumen" class="fw-bold text-primary">No hay ítems agregados</h5>
    </div>

    <div class="mt-3 text-end">
      <button type="submit" class="btn btn-success btn-lg">💾 Guardar Factura</button>
    </div>
  </form>
</div>

@include('facturas.partials.scripts')

@endsection
