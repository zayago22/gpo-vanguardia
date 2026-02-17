<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GaleriaImagen;
use Illuminate\Http\Request;

class GaleriaController extends Controller
{
    public function index()
    {
        $imagenes = GaleriaImagen::orderBy('orden')->get();
        return view('admin.galeria.index', compact('imagenes'));
    }

    public function create()
    {
        return view('admin.galeria.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'nullable|max:1000',
            'imagen' => 'required|image|max:2048',
            'categoria' => 'nullable|max:100',
            'activo' => 'boolean',
            'orden' => 'integer|min:0',
        ]);

        $data['activo'] = $request->has('activo');
        $data['imagen'] = $request->file('imagen')->store('galeria', 'public');

        GaleriaImagen::create($data);
        return redirect()->route('admin.galeria.index')->with('success', 'Imagen añadida correctamente.');
    }

    public function edit(GaleriaImagen $galerium)
    {
        $imagen = $galerium;
        return view('admin.galeria.form', compact('imagen'));
    }

    public function update(Request $request, GaleriaImagen $galerium)
    {
        $data = $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'nullable|max:1000',
            'imagen' => 'nullable|image|max:2048',
            'categoria' => 'nullable|max:100',
            'activo' => 'boolean',
            'orden' => 'integer|min:0',
        ]);

        $data['activo'] = $request->has('activo');

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('galeria', 'public');
        }

        $galerium->update($data);
        return redirect()->route('admin.galeria.index')->with('success', 'Imagen actualizada correctamente.');
    }

    public function show(GaleriaImagen $galerium)
    {
        return redirect()->route('admin.galeria.edit', $galerium);
    }

    public function destroy(GaleriaImagen $galerium)
    {
        $galerium->delete();
        return redirect()->route('admin.galeria.index')->with('success', 'Imagen eliminada.');
    }
}
