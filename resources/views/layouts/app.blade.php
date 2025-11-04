<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Taller - @yield('title', 'Facturación')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f6fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .navbar {
      background-color: #0d1b2a !important;
    }
    .navbar a {
      color: #fff !important;
      font-weight: 500;
    }
    .btn-primary {
      background-color: #2e8fff;
      border-color: #2e8fff;
    }
    .btn-primary:hover {
      background-color: #1b263b;
      border-color: #1b263b;
    }
    .card-custom {
      background: white;
      border-radius: 12px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
      padding: 20px;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="{{ url('/') }}">Taller Talachas</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav me-auto">
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
