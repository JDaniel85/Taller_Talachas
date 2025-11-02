@extends('layouts.app')

@section('content')
<h1>Facturas Emitidas</h1>
<a href="{{ route('facturas.create') }}" class="btn btn-primary">Nueva Factura</a>
<table class="table mt-3">
  <thead>
    <tr><th>ID</th><th>Cliente</th><th>Total</th><th>Fecha</th><th></th></tr>
  </thead>
  <tbody>
    @foreach($facturas as $factura)
    <tr>
      <td>{{ $factura->id }}</td>
      <td>{{ $factura->cliente->nombre }}</td>
      <td>${{ $factura->total }}</td>
      <td>{{ $factura->fecha }}</td>
      <td><a href="{{ route('facturas.show',$factura) }}" class="btn btn-sm btn-info">Ver</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
