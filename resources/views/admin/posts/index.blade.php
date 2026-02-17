@extends('admin.layouts.app')
@section('title', 'Blog / Posts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">{{ $posts->count() }} posts</p>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary-admin"><i class="fas fa-plus me-2"></i>Nuevo Post</a>
</div>

<div class="card-admin">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Título</th><th>Estado</th><th>Fecha</th><th>Acciones</th></tr></thead>
                <tbody>
                    @forelse($posts as $post)
                    <tr>
                        <td><strong>{{ $post->titulo }}</strong><br><small class="text-muted">{{ Str::limit($post->extracto, 60) }}</small></td>
                        <td>
                            @if($post->publicado) <span class="badge-activo">Publicado</span>
                            @else <span class="badge-inactivo">Borrador</span> @endif
                        </td>
                        <td>{{ $post->fecha_publicacion?->format('d/m/Y') ?? '—' }}</td>
                        <td>
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-muted py-4">No hay posts.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
