<?php

namespace App\Http\Controllers;

use App\Models\Refaccion;
use Illuminate\Http\Request;

class RefaccionController extends Controller
{
    public function index()
    {
        $refacciones = Refaccion::orderBy('nombre')->paginate(15);
        return view('refacciones.index', compact('refacciones'));
    }

    public function create()
    {
        return view('refacciones.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio_unitario' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Refaccion::create($data);
        return redirect()->route('refacciones.index')->with('success','Refacción creada.');
    }

    public function show(Refaccion $refaccion)
    {
        return view('refacciones.show', compact('refaccion'));
    }

    public function edit(Refaccion $refaccion)
    {
        return view('refacciones.edit', compact('refaccion'));
    }

    public function update(Request $request, Refaccion $refaccion)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio_unitario' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $refaccion->update($data);
        return redirect()->route('refacciones.index')->with('success','Refacción actualizada.');
    }

    public function destroy(Refaccion $refaccion)
    {
        $refaccion->delete();
        return redirect()->route('refacciones.index')->with('success','Refacción eliminada.');
    }
}
