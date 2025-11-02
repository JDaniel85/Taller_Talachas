<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Taller - @yield('title', 'Facturación')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ url('/') }}">Taller</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="{{ route('facturas.index') }}">Facturas</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('clientes.index') }}">Clientes</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('servicios.index') }}">Servicios</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('refacciones.index') }}">Refacciones</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
  @include('partials.alerts')
  @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
