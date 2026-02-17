@extends('admin.layouts.app')
@section('title', 'Testimonios')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">{{ $testimonios->count() }} testimonios</p>
    <a href="{{ route('admin.testimonios.create') }}" class="btn btn-primary-admin"><i class="fas fa-plus me-2"></i>Nuevo Testimonio</a>
</div>

<div class="card-admin">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Nombre</th><th>Empresa</th><th>Estrellas</th><th>Estado</th><th>Acciones</th></tr></thead>
                <tbody>
                    @forelse($testimonios as $t)
                    <tr>
                        <td><strong>{{ $t->nombre }}</strong><br><small class="text-muted">{{ $t->cargo }}</small></td>
                        <td>{{ $t->empresa ?? '—' }}</td>
                        <td>
                            @for($i = 0; $i < $t->estrellas; $i++)
                                <i class="fas fa-star" style="color: #F59E0B; font-size: 12px;"></i>
                            @endfor
                        </td>
                        <td>
                            @if($t->activo) <span class="badge-activo">Activo</span>
                            @else <span class="badge-inactivo">Inactivo</span> @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.testimonios.edit', $t) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.testimonios.destroy', $t) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">No hay testimonios.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
