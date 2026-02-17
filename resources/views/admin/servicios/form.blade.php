@extends('admin.layouts.app')
@section('title', isset($servicio) ? 'Editar Servicio' : 'Nuevo Servicio')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card-admin">
            <div class="card-body">
                <form action="{{ isset($servicio) ? route('admin.servicios.update', $servicio) : route('admin.servicios.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($servicio)) @method('PUT') @endif

                    <div class="mb-3">
                        <label class="form-label">Nombre *</label>
                        <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $servicio->nombre ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción *</label>
                        <textarea class="form-control" name="descripcion" rows="4" required>{{ old('descripcion', $servicio->descripcion ?? '') }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Icono (Font Awesome class)</label>
                            <input type="text" class="form-control" name="icono" value="{{ old('icono', $servicio->icono ?? '') }}" placeholder="fas fa-robot">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Orden</label>
                            <input type="number" class="form-control" name="orden" value="{{ old('orden', $servicio->orden ?? 0) }}" min="0">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Imagen</label>
                        <input type="file" class="form-control" name="imagen" accept="image/*">
                        @if(isset($servicio) && $servicio->imagen)
                            <img src="{{ asset('storage/' . $servicio->imagen) }}" class="mt-2 rounded" style="max-height: 100px;">
                        @endif
                    </div>
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="activo" value="1" id="activo" {{ old('activo', $servicio->activo ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="activo">Activo</label>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary-admin"><i class="fas fa-save me-2"></i>Guardar</button>
                        <a href="{{ route('admin.servicios.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
