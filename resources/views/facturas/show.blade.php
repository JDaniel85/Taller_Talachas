@extends('layouts.app')

@section('content')
<h2>Factura #{{ $factura->id }}</h2>
<p><strong>Cliente:</strong> {{ $factura->cliente->nombre }}</p>
<p><strong>RFC:</strong> {{ $factura->cliente->rfc }}</p>

<table class="table">
  <thead>
    <tr><th>Concepto</th><th>Cantidad</th><th>Precio</th><th>Total</th></tr>
  </thead>
  <tbody>
    @foreach($factura->detalles as $d)
      <tr>
        <td>
          {{ $d->servicio_id ? $d->servicio->descripcion : $d->refaccion->nombre }}
        </td>
        <td>{{ $d->cantidad }}</td>
        <td>${{ $d->precio_unitario }}</td>
        <td>${{ $d->total }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

<p><strong>Subtotal:</strong> ${{ $factura->subtotal }}</p>
<p><strong>IVA (16%):</strong> ${{ $factura->impuestos }}</p>
<p><strong>Total:</strong> ${{ $factura->total }}</p>
@endsection
