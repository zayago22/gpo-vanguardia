@extends('admin.layouts.app')
@section('title', 'Galería')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">{{ $imagenes->count() }} imágenes</p>
    <a href="{{ route('admin.galeria.create') }}" class="btn btn-primary-admin"><i class="fas fa-plus me-2"></i>Nueva Imagen</a>
</div>

<div class="row g-3">
    @forelse($imagenes as $img)
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card-admin" style="overflow: hidden;">
            <img src="{{ asset('storage/' . $img->imagen) }}" style="width: 100%; height: 160px; object-fit: cover;">
            <div class="card-body p-3">
                <h6 class="mb-1" style="font-size: 14px; font-weight: 600;">{{ $img->titulo }}</h6>
                @if($img->categoria)
                    <span class="badge bg-light text-dark" style="font-size: 11px;">{{ $img->categoria }}</span>
                @endif
                <div class="mt-2 d-flex gap-1">
                    <a href="{{ route('admin.galeria.edit', $img) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.galeria.destroy', $img) }}" method="POST" onsubmit="return confirm('¿Eliminar?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card-admin">
            <div class="card-body text-center text-muted py-5">
                <i class="fas fa-images fa-3x mb-3"></i>
                <p>No hay imágenes en la galería.</p>
                <a href="{{ route('admin.galeria.create') }}" class="btn btn-primary-admin btn-sm">Añadir primera imagen</a>
            </div>
        </div>
    </div>
    @endforelse
</div>
@endsection
