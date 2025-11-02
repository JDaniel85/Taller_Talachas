<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::orderBy('id','desc')->paginate(15);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'rfc' => 'required|string|max:13|unique:clientes,rfc',
            'direccion' => 'nullable|string',
            'correo' => 'nullable|email',
            'telefono' => 'nullable|string|max:15',
        ]);

        Cliente::create($data);
        return redirect()->route('clientes.index')->with('success','Cliente creado correctamente.');
    }

    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'rfc' => "required|string|max:13|unique:clientes,rfc,{$cliente->id}",
            'direccion' => 'nullable|string',
            'correo' => 'nullable|email',
            'telefono' => 'nullable|string|max:15',
        ]);

        $cliente->update($data);
        return redirect()->route('clientes.index')->with('success','Cliente actualizado.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success','Cliente eliminado.');
    }
}
