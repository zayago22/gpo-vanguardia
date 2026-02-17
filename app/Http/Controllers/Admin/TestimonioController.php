<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonio;
use Illuminate\Http\Request;

class TestimonioController extends Controller
{
    public function index()
    {
        $testimonios = Testimonio::orderBy('orden')->get();
        return view('admin.testimonios.index', compact('testimonios'));
    }

    public function create()
    {
        return view('admin.testimonios.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|max:255',
            'cargo' => 'nullable|max:255',
            'empresa' => 'nullable|max:255',
            'texto' => 'required|max:2000',
            'estrellas' => 'required|integer|min:1|max:5',
            'activo' => 'boolean',
            'orden' => 'integer|min:0',
        ]);

        $data['activo'] = $request->has('activo');

        Testimonio::create($data);
        return redirect()->route('admin.testimonios.index')->with('success', 'Testimonio creado correctamente.');
    }

    public function edit(Testimonio $testimonio)
    {
        return view('admin.testimonios.form', compact('testimonio'));
    }

    public function update(Request $request, Testimonio $testimonio)
    {
        $data = $request->validate([
            'nombre' => 'required|max:255',
            'cargo' => 'nullable|max:255',
            'empresa' => 'nullable|max:255',
            'texto' => 'required|max:2000',
            'estrellas' => 'required|integer|min:1|max:5',
            'activo' => 'boolean',
            'orden' => 'integer|min:0',
        ]);

        $data['activo'] = $request->has('activo');

        $testimonio->update($data);
        return redirect()->route('admin.testimonios.index')->with('success', 'Testimonio actualizado.');
    }

    public function show(Testimonio $testimonio)
    {
        return redirect()->route('admin.testimonios.edit', $testimonio);
    }

    public function destroy(Testimonio $testimonio)
    {
        $testimonio->delete();
        return redirect()->route('admin.testimonios.index')->with('success', 'Testimonio eliminado.');
    }
}
