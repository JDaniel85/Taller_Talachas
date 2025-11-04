@php
use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Factura #{{ $factura->id }} - Teller Talachas</title>
<style>
    body {
        font-family: 'DejaVu Sans', sans-serif;
        margin: 0;
        padding: 0;
        color: #0d1b2a;
        background-color: #f5f6fa;
    }
    .header {
        background: linear-gradient(90deg, #0d1b2a, #1b263b);
        color: white;
        padding: 20px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .header h1 {
        font-size: 26px;
        margin: 0;
        letter-spacing: 1px;
    }
    .logo {
        width: 80px;
        height: 80px;
        background-color: #ffcc00;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #0d1b2a;
        font-weight: 900;
        font-size: 20px;
        box-shadow: 0 0 10px rgba(255,255,255,0.3);
    }
    .info-taller {
        padding: 20px 40px;
        background-color: #e9ecef;
        border-bottom: 3px solid #2e8fff;
    }
    .info-taller p {
        margin: 4px 0;
        font-size: 13px;
    }
    .section {
        padding: 25px 40px;
    }
    h2 {
        border-left: 6px solid #2e8fff;
        padding-left: 10px;
        color: #2e8fff;
        font-size: 18px;
        margin-bottom: 10px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }
    th, td {
        border: 1px solid #b8c0cc;
        padding: 8px 10px;
        text-align: left;
        font-size: 13px;
    }
    th {
        background-color: #2e8fff;
        color: white;
        text-transform: uppercase;
    }
    .totales {
        margin-top: 15px;
        width: 100%;
        border-top: 3px solid #2e8fff;
    }
    .totales td {
        text-align: right;
        font-size: 14px;
        padding: 4px 0;
    }
    .totales strong {
        color: #0d1b2a;
    }
    .footer {
        background-color: #0d1b2a;
        color: white;
        padding: 10px 0;
        text-align: center;
        font-size: 12px;
        position: fixed;
        bottom: 0;
        width: 100%;
    }
    .watermark {
        position: absolute;
        top: 45%;
        left: 25%;
        opacity: 0.06;
        font-size: 100px;
        transform: rotate(-20deg);
        color: #0d1b2a;
        font-weight: bold;
    }
</style>
</head>
<body>

<div class="header">
    <div>
        <h1>Teller Talachas</h1>
        <small>Factura N.º {{ $factura->id }}</small>
    </div>
    <div class="logo">
        <span>TT</span>
    </div>
</div>

<div class="info-taller">
    <p><strong>Dirección:</strong> Av. Revolución #123, Col. Industrial, CDMX</p>
    <p><strong>Tel:</strong> (55) 1234-5678 — <strong>Email:</strong> contacto@tellertalachas.com</p>
    <p><strong>RFC:</strong> TTT890123AB9</p>
</div>

<div class="section">
    <h2>Datos del Cliente</h2>
    <p><strong>Nombre:</strong> {{ $factura->cliente->nombre }}</p>
    <p><strong>RFC:</strong> {{ $factura->cliente->rfc }}</p>
    <p><strong>Fecha de emisión:</strong> {{ Carbon::parse($factura->created_at)->format('d/m/Y H:i') }}</p>
</div>

<div class="section">
    <h2>Detalle de Conceptos</h2>
    <table>
        <thead>
            <tr>
                <th>Concepto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Importe</th>
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
                <td>${{ number_format($d->total,2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="totales">
        <tr>
            <td><strong>Subtotal:</strong> ${{ number_format($factura->subtotal,2) }}</td>
        </tr>
        <tr>
            <td><strong>IVA (16%):</strong> ${{ number_format($factura->impuestos,2) }}</td>
        </tr>
        <tr>
            <td><strong style="font-size:16px;">Total:</strong> <strong style="font-size:16px;">${{ number_format($factura->total,2) }}</strong></td>
        </tr>
    </table>
</div>

<div class="watermark">Teller Talachas</div>

<div class="footer">
    <p>Gracias por confiar en Teller Talachas ⚙️ | Servicio y calidad garantizada.</p>
</div>

</body>
</html>
