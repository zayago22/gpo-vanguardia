@extends('admin.layouts.app')
@section('title', isset($testimonio) ? 'Editar Testimonio' : 'Nuevo Testimonio')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card-admin">
            <div class="card-body">
                <form action="{{ isset($testimonio) ? route('admin.testimonios.update', $testimonio) : route('admin.testimonios.store') }}" method="POST">
                    @csrf
                    @if(isset($testimonio)) @method('PUT') @endif

                    <div class="mb-3">
                        <label class="form-label">Nombre *</label>
                        <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $testimonio->nombre ?? '') }}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Cargo</label>
                            <input type="text" class="form-control" name="cargo" value="{{ old('cargo', $testimonio->cargo ?? '') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Empresa</label>
                            <input type="text" class="form-control" name="empresa" value="{{ old('empresa', $testimonio->empresa ?? '') }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Texto del testimonio *</label>
                        <textarea class="form-control" name="texto" rows="4" required>{{ old('texto', $testimonio->texto ?? '') }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Estrellas *</label>
                            <select class="form-select" name="estrellas" required>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('estrellas', $testimonio->estrellas ?? 5) == $i ? 'selected' : '' }}>{{ $i }} estrella{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Orden</label>
                            <input type="number" class="form-control" name="orden" value="{{ old('orden', $testimonio->orden ?? 0) }}" min="0">
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="activo" value="1" id="activo" {{ old('activo', $testimonio->activo ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="activo">Activo</label>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary-admin"><i class="fas fa-save me-2"></i>Guardar</button>
                        <a href="{{ route('admin.testimonios.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
