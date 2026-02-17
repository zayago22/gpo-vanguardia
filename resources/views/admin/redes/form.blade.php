@extends('admin.layouts.app')
@section('title', isset($red) ? 'Editar Red Social' : 'Nueva Red Social')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card-admin">
            <div class="card-body">
                <form action="{{ isset($red) ? route('admin.redes-sociales.update', $red) : route('admin.redes-sociales.store') }}" method="POST">
                    @csrf
                    @if(isset($red)) @method('PUT') @endif

                    <div class="mb-3">
                        <label class="form-label">Nombre *</label>
                        <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $red->nombre ?? '') }}" required placeholder="Facebook, LinkedIn, Instagram...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icono (Font Awesome class) *</label>
                        <input type="text" class="form-control" name="icono" value="{{ old('icono', $red->icono ?? '') }}" required placeholder="fab fa-facebook-f">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL *</label>
                        <input type="url" class="form-control" name="url" value="{{ old('url', $red->url ?? '') }}" required placeholder="https://facebook.com/...">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Orden</label>
                            <input type="number" class="form-control" name="orden" value="{{ old('orden', $red->orden ?? 0) }}" min="0">
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="activo" value="1" id="activo" {{ old('activo', $red->activo ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="activo">Activo</label>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary-admin"><i class="fas fa-save me-2"></i>Guardar</button>
                        <a href="{{ route('admin.redes-sociales.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
