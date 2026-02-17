@extends('admin.layouts.app')
@section('title', 'Redes Sociales')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">{{ $redes->count() }} redes sociales</p>
    <a href="{{ route('admin.redes-sociales.create') }}" class="btn btn-primary-admin"><i class="fas fa-plus me-2"></i>Nueva Red</a>
</div>

<div class="card-admin">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Orden</th><th>Nombre</th><th>Icono</th><th>URL</th><th>Estado</th><th>Acciones</th></tr></thead>
                <tbody>
                    @forelse($redes as $r)
                    <tr>
                        <td>{{ $r->orden }}</td>
                        <td><strong>{{ $r->nombre }}</strong></td>
                        <td><i class="{{ $r->icono }}"></i></td>
                        <td><a href="{{ $r->url }}" target="_blank" class="text-muted" style="font-size: 13px;">{{ Str::limit($r->url, 40) }}</a></td>
                        <td>
                            @if($r->activo) <span class="badge-activo">Activo</span>
                            @else <span class="badge-inactivo">Inactivo</span> @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.redes-sociales.edit', $r) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.redes-sociales.destroy', $r) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">No hay redes sociales.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
