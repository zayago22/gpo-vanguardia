<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::orderBy('orden')->get();
        return view('admin.servicios.index', compact('servicios'));
    }

    public function create()
    {
        return view('admin.servicios.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:5000',
            'icono' => 'nullable|max:100|regex:/^[a-z\s\-]+$/',
            'imagen' => 'nullable|image|max:2048',
            'activo' => 'boolean',
            'orden' => 'integer|min:0',
        ]);

        $data['slug'] = Str::slug($data['nombre']);
        $data['activo'] = $request->has('activo');

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('servicios', 'public');
        }

        Servicio::create($data);
        return redirect()->route('admin.servicios.index')->with('success', 'Servicio creado correctamente.');
    }

    public function edit(Servicio $servicio)
    {
        return view('admin.servicios.form', compact('servicio'));
    }

    public function update(Request $request, Servicio $servicio)
    {
        $data = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:5000',
            'icono' => 'nullable|max:100|regex:/^[a-z\s\-]+$/',
            'imagen' => 'nullable|image|max:2048',
            'activo' => 'boolean',
            'orden' => 'integer|min:0',
        ]);

        $data['slug'] = Str::slug($data['nombre']);
        $data['activo'] = $request->has('activo');

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('servicios', 'public');
        }

        $servicio->update($data);
        return redirect()->route('admin.servicios.index')->with('success', 'Servicio actualizado correctamente.');
    }

    public function show(Servicio $servicio)
    {
        return redirect()->route('admin.servicios.edit', $servicio);
    }

    public function destroy(Servicio $servicio)
    {
        $servicio->delete();
        return redirect()->route('admin.servicios.index')->with('success', 'Servicio eliminado.');
    }
}
