<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ValorCorporativo;
use Illuminate\Http\Request;

class ValorController extends Controller
{
    public function index()
    {
        $valores = ValorCorporativo::orderBy('orden')->get();
        return view('admin.valores.index', compact('valores'));
    }

    public function create()
    {
        return view('admin.valores.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:1000',
            'icono' => 'nullable|max:100|regex:/^[a-z\s\-]+$/',
            'activo' => 'boolean',
            'orden' => 'integer|min:0',
        ]);

        $data['activo'] = $request->has('activo');

        ValorCorporativo::create($data);
        return redirect()->route('admin.valores.index')->with('success', 'Valor creado correctamente.');
    }

    public function edit(ValorCorporativo $valore)
    {
        $valor = $valore;
        return view('admin.valores.form', compact('valor'));
    }

    public function update(Request $request, ValorCorporativo $valore)
    {
        $data = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:1000',
            'icono' => 'nullable|max:100|regex:/^[a-z\s\-]+$/',
            'activo' => 'boolean',
            'orden' => 'integer|min:0',
        ]);

        $data['activo'] = $request->has('activo');

        $valore->update($data);
        return redirect()->route('admin.valores.index')->with('success', 'Valor actualizado.');
    }

    public function show(ValorCorporativo $valore)
    {
        return redirect()->route('admin.valores.edit', $valore);
    }

    public function destroy(ValorCorporativo $valore)
    {
        $valore->delete();
        return redirect()->route('admin.valores.index')->with('success', 'Valor eliminado.');
    }
}
