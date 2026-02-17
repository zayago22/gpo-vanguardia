@extends('admin.layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(67,56,202,0.1); color: #4338CA;"><i class="fas fa-cogs"></i></div>
            <h3>{{ $stats['servicios'] }}</h3>
            <p>Servicios</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(16,185,129,0.1); color: #10B981;"><i class="fas fa-newspaper"></i></div>
            <h3>{{ $stats['posts'] }}</h3>
            <p>Posts</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(245,158,11,0.1); color: #F59E0B;"><i class="fas fa-images"></i></div>
            <h3>{{ $stats['galeria'] }}</h3>
            <p>Imágenes</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(239,68,68,0.1); color: #EF4444;"><i class="fas fa-envelope"></i></div>
            <h3>{{ $stats['contactos_nuevos'] }}</h3>
            <p>Contactos nuevos</p>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card-admin">
            <div class="card-body">
                <h5 class="mb-3" style="font-weight: 700; color: #1E293B;">Últimos Contactos</h5>
                @if($contactos->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead><tr><th>Nombre</th><th>Email</th><th>Fecha</th><th>Estado</th></tr></thead>
                        <tbody>
                            @foreach($contactos as $c)
                            <tr>
                                <td>{{ $c->nombre }}</td>
                                <td>{{ $c->email }}</td>
                                <td>{{ $c->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    @if($c->leido)
                                        <span class="badge-activo">Leído</span>
                                    @else
                                        <span class="badge-inactivo">Nuevo</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted">No hay contactos todavía.</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-admin">
            <div class="card-body">
                <h5 class="mb-3" style="font-weight: 700; color: #1E293B;">Accesos Rápidos</h5>
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary-admin"><i class="fas fa-plus me-2"></i>Nuevo Post</a>
                    <a href="{{ route('admin.servicios.create') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-plus me-2"></i>Nuevo Servicio</a>
                    <a href="{{ route('admin.galeria.create') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-plus me-2"></i>Nueva Imagen</a>
                    <a href="{{ route('admin.testimonios.create') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-plus me-2"></i>Nuevo Testimonio</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
