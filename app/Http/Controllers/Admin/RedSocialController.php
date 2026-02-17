<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RedSocial;
use Illuminate\Http\Request;

class RedSocialController extends Controller
{
    public function index()
    {
        $redes = RedSocial::orderBy('orden')->get();
        return view('admin.redes.index', compact('redes'));
    }

    public function create()
    {
        return view('admin.redes.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|max:100',
            'icono' => 'required|max:100|regex:/^[a-z\s\-]+$/',
            'url' => 'required|url|max:500',
            'activo' => 'boolean',
            'orden' => 'integer|min:0',
        ]);

        $data['activo'] = $request->has('activo');

        RedSocial::create($data);
        return redirect()->route('admin.redes-sociales.index')->with('success', 'Red social creada correctamente.');
    }

    public function edit(RedSocial $redSocial)
    {
        return view('admin.redes.form', ['red' => $redSocial]);
    }

    public function update(Request $request, RedSocial $redSocial)
    {
        $data = $request->validate([
            'nombre' => 'required|max:100',
            'icono' => 'required|max:100|regex:/^[a-z\s\-]+$/',
            'url' => 'required|url|max:500',
            'activo' => 'boolean',
            'orden' => 'integer|min:0',
        ]);

        $data['activo'] = $request->has('activo');

        $redSocial->update($data);
        return redirect()->route('admin.redes-sociales.index')->with('success', 'Red social actualizada.');
    }

    public function show(RedSocial $redSocial)
    {
        return redirect()->route('admin.redes-sociales.edit', $redSocial);
    }

    public function destroy(RedSocial $redSocial)
    {
        $redSocial->delete();
        return redirect()->route('admin.redes-sociales.index')->with('success', 'Red social eliminada.');
    }
}
