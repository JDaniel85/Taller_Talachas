@extends('layouts.app')
@section('title', 'Factura #'.$factura->id)
@section('content')

<div class="card-custom">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="text-primary fw-bold mb-0">Factura #{{ $factura->id }}</h2>
    <div>
      <a href="{{ route('facturas.print', $factura->id) }}" class="btn btn-primary me-2">🖨️ Imprimir</a>
      <a href="{{ route('facturas.download', $factura->id) }}" class="btn btn-outline-dark">⬇️ Descargar PDF</a>
    </div>
  </div>

  <p><strong>Cliente:</strong> {{ $factura->cliente->nombre }}</p>
  <p><strong>RFC:</strong> {{ $factura->cliente->rfc }}</p>
  <p><strong>Fecha de emisión:</strong> {{ $factura->created_at->format('d/m/Y H:i') }}</p>

  <table class="table table-bordered mt-4">
    <thead class="table-primary">
      <tr>
        <th>Concepto</th>
        <th>Cantidad</th>
        <th>Precio Unitario</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach($factura->detalles as $d)
        <tr>
          <td>
            @if($d->servicio)
              Servicio: {{ $d->servicio->descripcion }}
            @elseif($d->refaccion)
              Refacción: {{ $d->refaccion->nombre }}
            @endif
          </td>
          <td>{{ $d->cantidad }}</td>
          <td>${{ number_format($d->precio_unitario,2) }}</td>
          <td><strong>${{ number_format($d->total,2) }}</strong></td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="text-end mt-3">
    <p><strong>Subtotal:</strong> ${{ number_format($factura->subtotal,2) }}</p>
    <p><strong>IVA (16%):</strong> ${{ number_format($factura->impuestos,2) }}</p>
    <h4 class="text-primary fw-bold">Total: ${{ number_format($factura->total,2) }}</h4>
  </div>
</div>

@endsection
