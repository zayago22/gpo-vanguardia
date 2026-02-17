@extends('admin.layouts.app')
@section('title', 'Contactos')

@section('content')
<div class="card-admin">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Fecha</th><th>Nombre</th><th>Email</th><th>Empresa</th><th>Estado</th><th>Acciones</th></tr></thead>
                <tbody>
                    @forelse($contactos as $c)
                    <tr style="{{ !$c->leido ? 'background: #FEF3C7;' : '' }}">
                        <td style="font-size: 13px;">{{ $c->created_at->format('d/m/Y H:i') }}</td>
                        <td><strong>{{ $c->nombre }}</strong></td>
                        <td><a href="mailto:{{ $c->email }}">{{ $c->email }}</a></td>
                        <td>{{ $c->empresa ?? '—' }}</td>
                        <td>
                            @if($c->leido) <span class="badge-activo">Leído</span>
                            @else <span class="badge-inactivo">Nuevo</span> @endif
                        </td>
                        <td class="d-flex gap-1">
                            <!-- Toggle read/view -->
                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal{{ $c->id }}"><i class="fas fa-eye"></i></button>
                            @if(!$c->leido)
                            <form action="{{ route('admin.contactos.leido', $c) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm btn-outline-success" title="Marcar leído"><i class="fas fa-check"></i></button>
                            </form>
                            @endif
                            <form action="{{ route('admin.contactos.destroy', $c) }}" method="POST" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">No hay contactos.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($contactos->hasPages())
<div class="mt-3">{{ $contactos->links() }}</div>
@endif

<!-- Modales -->
@foreach($contactos as $c)
<div class="modal fade" id="modal{{ $c->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header">
                <h5 class="modal-title" style="font-weight: 700;">{{ $c->nombre }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>Email:</strong> {{ $c->email }}</p>
                @if($c->telefono)<p><strong>Teléfono:</strong> {{ $c->telefono }}</p>@endif
                @if($c->empresa)<p><strong>Empresa:</strong> {{ $c->empresa }}</p>@endif
                <hr>
                <p>{{ $c->mensaje }}</p>
                <small class="text-muted">Recibido: {{ $c->created_at->format('d/m/Y H:i') }}</small>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
