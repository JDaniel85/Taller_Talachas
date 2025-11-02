<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::orderBy('descripcion')->paginate(15);
        return view('servicios.index', compact('servicios'));
    }

    public function create()
    {
        return view('servicios.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'descripcion' => 'required|string|max:200',
            'costo' => 'required|numeric|min:0'
        ]);

        Servicio::create($data);
        return redirect()->route('servicios.index')->with('success','Servicio creado correctamente.');
    }

    public function show(Servicio $servicio)
    {
        return view('servicios.show', compact('servicio'));
    }

    public function edit(Servicio $servicio)
    {
        return view('servicios.edit', compact('servicio'));
    }

    public function update(Request $request, Servicio $servicio)
    {
        $data = $request->validate([
            'descripcion' => 'required|string|max:200',
            'costo' => 'required|numeric|min:0'
        ]);

        $servicio->update($data);
        return redirect()->route('servicios.index')->with('success','Servicio actualizado.');
    }

    public function destroy(Servicio $servicio)
    {
        $servicio->delete();
        return redirect()->route('servicios.index')->with('success','Servicio eliminado.');
    }
}
