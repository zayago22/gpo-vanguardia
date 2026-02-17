@extends('admin.layouts.app')
@section('title', isset($valor) ? 'Editar Valor' : 'Nuevo Valor')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card-admin">
            <div class="card-body">
                <form action="{{ isset($valor) ? route('admin.valores.update', $valor) : route('admin.valores.store') }}" method="POST">
                    @csrf
                    @if(isset($valor)) @method('PUT') @endif

                    <div class="mb-3">
                        <label class="form-label">Nombre *</label>
                        <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $valor->nombre ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción *</label>
                        <textarea class="form-control" name="descripcion" rows="3" required>{{ old('descripcion', $valor->descripcion ?? '') }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Icono (Font Awesome class)</label>
                            <input type="text" class="form-control" name="icono" value="{{ old('icono', $valor->icono ?? '') }}" placeholder="fas fa-star">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Orden</label>
                            <input type="number" class="form-control" name="orden" value="{{ old('orden', $valor->orden ?? 0) }}" min="0">
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="activo" value="1" id="activo" {{ old('activo', $valor->activo ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="activo">Activo</label>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary-admin"><i class="fas fa-save me-2"></i>Guardar</button>
                        <a href="{{ route('admin.valores.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
