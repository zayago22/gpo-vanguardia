@extends('admin.layouts.app')
@section('title', 'Servicios')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">{{ $servicios->count() }} servicios registrados</p>
    <a href="{{ route('admin.servicios.create') }}" class="btn btn-primary-admin"><i class="fas fa-plus me-2"></i>Nuevo Servicio</a>
</div>

<div class="card-admin">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Orden</th><th>Nombre</th><th>Icono</th><th>Estado</th><th>Acciones</th></tr></thead>
                <tbody>
                    @forelse($servicios as $s)
                    <tr>
                        <td>{{ $s->orden }}</td>
                        <td><strong>{{ $s->nombre }}</strong></td>
                        <td><i class="{{ $s->icono }}"></i> <small class="text-muted">{{ $s->icono }}</small></td>
                        <td>
                            @if($s->activo) <span class="badge-activo">Activo</span>
                            @else <span class="badge-inactivo">Inactivo</span> @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.servicios.edit', $s) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.servicios.destroy', $s) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">No hay servicios.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
