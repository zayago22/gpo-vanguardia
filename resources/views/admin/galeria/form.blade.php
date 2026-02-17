@extends('admin.layouts.app')
@section('title', isset($imagen) ? 'Editar Imagen' : 'Nueva Imagen')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card-admin">
            <div class="card-body">
                <form action="{{ isset($imagen) ? route('admin.galeria.update', $imagen) : route('admin.galeria.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($imagen)) @method('PUT') @endif

                    <div class="mb-3">
                        <label class="form-label">Título *</label>
                        <input type="text" class="form-control" name="titulo" value="{{ old('titulo', $imagen->titulo ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion" rows="2">{{ old('descripcion', $imagen->descripcion ?? '') }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Imagen {{ isset($imagen) ? '' : '*' }}</label>
                            <input type="file" class="form-control" name="imagen" accept="image/*" {{ isset($imagen) ? '' : 'required' }}>
                            @if(isset($imagen))
                                <img src="{{ asset('storage/' . $imagen->imagen) }}" class="mt-2 rounded" style="max-height: 100px;">
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Categoría</label>
                            <input type="text" class="form-control" name="categoria" value="{{ old('categoria', $imagen->categoria ?? '') }}" placeholder="Ej: Oficinas, Equipo, Eventos">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Orden</label>
                            <input type="number" class="form-control" name="orden" value="{{ old('orden', $imagen->orden ?? 0) }}" min="0">
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="activo" value="1" id="activo" {{ old('activo', $imagen->activo ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="activo">Activo</label>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary-admin"><i class="fas fa-save me-2"></i>Guardar</button>
                        <a href="{{ route('admin.galeria.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
