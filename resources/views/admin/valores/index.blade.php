@extends('admin.layouts.app')
@section('title', 'Valores Corporativos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">{{ $valores->count() }} valores</p>
    <a href="{{ route('admin.valores.create') }}" class="btn btn-primary-admin"><i class="fas fa-plus me-2"></i>Nuevo Valor</a>
</div>

<div class="card-admin">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Orden</th><th>Nombre</th><th>Icono</th><th>Estado</th><th>Acciones</th></tr></thead>
                <tbody>
                    @forelse($valores as $v)
                    <tr>
                        <td>{{ $v->orden }}</td>
                        <td><strong>{{ $v->nombre }}</strong><br><small class="text-muted">{{ Str::limit($v->descripcion, 50) }}</small></td>
                        <td><i class="{{ $v->icono }}"></i></td>
                        <td>
                            @if($v->activo) <span class="badge-activo">Activo</span>
                            @else <span class="badge-inactivo">Inactivo</span> @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.valores.edit', $v) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.valores.destroy', $v) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">No hay valores.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
