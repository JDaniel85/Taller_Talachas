<?php

namespace App\Http\Controllers;

use App\Models\Factura;
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
            'items' => 'required|array|min:1'
        ]);

        DB::transaction(function () use ($request, &$factura) {
            $factura = Factura::create([
                'cliente_id' => $request->cliente_id,
                'subtotal' => 0,
                'impuestos' => 0,
                'total' => 0
            ]);

            $subtotal = 0;
            foreach ($request->items as $item) {
                // validar que exista price y cantidad
                $cantidad = isset($item['cantidad']) ? intval($item['cantidad']) : 1;
                $precio_unitario = isset($item['precio_unitario']) ? floatval($item['precio_unitario']) : 0;
                $totalItem = round($cantidad * $precio_unitario, 2);

                FacturaDetalle::create([
                    'factura_id' => $factura->id,
                    'servicio_id' => $item['servicio_id'] ?? null,
                    'refaccion_id' => $item['refaccion_id'] ?? null,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precio_unitario,
                    'total' => $totalItem
                ]);

                // si es refacción, disminuir stock
                if (!empty($item['refaccion_id'])) {
                    $ref = Refaccion::find($item['refaccion_id']);
                    if ($ref) {
                        $ref->decrement('stock', $cantidad);
                    }
                }

                $subtotal += $totalItem;
            }

            $impuestos = round($subtotal * 0.16, 2);
            $total = round($subtotal + $impuestos, 2);

            $factura->update([
                'subtotal' => $subtotal,
                'impuestos' => $impuestos,
                'total' => $total
            ]);
        });

        return redirect()->route('facturas.index')->with('success','Factura creada correctamente.');
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
}
