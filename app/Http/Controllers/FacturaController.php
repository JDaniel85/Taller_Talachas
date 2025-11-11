<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\FacturaDetalle;
use App\Models\Cliente;
use App\Models\Servicio;
use App\Models\Refaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{
    public function index()
    {
        $facturas = Factura::with('cliente')->orderByDesc('id')->paginate(15);
        return view('facturas.index', compact('facturas'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        $servicios = Servicio::orderBy('descripcion')->get();
        $refacciones = Refaccion::orderBy('nombre')->get();
        return view('facturas.create', compact('clientes','servicios','refacciones'));
    }

    public function store(Request $request)
{
    $request->validate([
        'cliente_id' => 'required|exists:clientes,id',
        'items_json' => 'required'  // ✅ Cambiamos esto
    ], [
        'items_json.required' => 'Debe agregar al menos un concepto a la factura.'
    ]);

    // ✅ Decode JSON de items
    $items = json_decode($request->items_json, true);

    if (!$items || count($items) === 0) {
        return back()->withErrors(['items_json' => 'Debe agregar al menos un ítem.'])->withInput();
    }

    // 🔹 Cálculos
    $subtotal = 0;

    foreach ($items as $i) {
        $subtotal += floatval($i['total']);
    }

    $impuestos = $subtotal * 0.16;
    $total = $subtotal + $impuestos;

    // ✅ Crear factura
    $factura = Factura::create([
        'cliente_id' => $request->cliente_id,
        'subtotal'   => $subtotal,
        'impuestos'  => $impuestos,
        'total'      => $total,
        'estatus'    => 'emitida',
    ]);

    // ✅ Insertar detalles
    foreach ($items as $i) {
        FacturaDetalle::create([
            'factura_id' => $factura->id,
            'servicio_id' => $i['tipo'] === 'servicio' ? $i['id'] : null,
            'refaccion_id' => $i['tipo'] === 'refaccion' ? $i['id'] : null,
            'cantidad' => $i['cantidad'],
            'precio_unitario' => $i['precio_unitario'],
            'total' => $i['total']
        ]);

        // ✅ Reducir stock si es refacción
        if ($i['tipo'] === 'refaccion') {
            Refaccion::where('id', $i['id'])->decrement('stock', $i['cantidad']);
        }
    }

    return redirect()->route('facturas.show', $factura->id)
        ->with('success', 'Factura generada correctamente ✅');
}


    public function show(Factura $factura)
    {
        $factura->load('cliente','detalles.servicio','detalles.refaccion');
        return view('facturas.show', compact('factura'));
    }

    public function destroy(Factura $factura)
    {
        $factura->delete();
        return redirect()->route('facturas.index')->with('success','Factura eliminada.');
    }

    public function print(Factura $factura)
    {
        $factura->load('cliente','detalles.servicio','detalles.refaccion');
        return view('facturas.show', compact('factura'));
    }

    public function download(Factura $factura)
    {
        $factura->load('cliente','detalles.servicio','detalles.refaccion');
        $pdf = Pdf::loadView('facturas.pdf', compact('factura'));
        return $pdf->download("Factura_TellerTalachas_{$factura->id}.pdf");
    }
}
