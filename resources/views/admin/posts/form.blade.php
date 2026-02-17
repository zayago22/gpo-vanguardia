@extends('admin.layouts.app')
@section('title', isset($post) ? 'Editar Post' : 'Nuevo Post')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card-admin">
            <div class="card-body">
                <form action="{{ isset($post) ? route('admin.posts.update', $post) : route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($post)) @method('PUT') @endif

                    <div class="mb-3">
                        <label class="form-label">Título *</label>
                        <input type="text" class="form-control" name="titulo" value="{{ old('titulo', $post->titulo ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Extracto</label>
                        <textarea class="form-control" name="extracto" rows="2" maxlength="500">{{ old('extracto', $post->extracto ?? '') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contenido *</label>
                        <textarea class="form-control" name="contenido" rows="12" required>{{ old('contenido', $post->contenido ?? '') }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Imagen de portada</label>
                            <input type="file" class="form-control" name="imagen_portada" accept="image/*">
                            @if(isset($post) && $post->imagen_portada)
                                <img src="{{ asset('storage/' . $post->imagen_portada) }}" class="mt-2 rounded" style="max-height: 100px;">
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha de publicación</label>
                            <input type="datetime-local" class="form-control" name="fecha_publicacion" value="{{ old('fecha_publicacion', isset($post) && $post->fecha_publicacion ? $post->fecha_publicacion->format('Y-m-d\TH:i') : '') }}">
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="publicado" value="1" id="publicado" {{ old('publicado', $post->publicado ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label" for="publicado">Publicado</label>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary-admin"><i class="fas fa-save me-2"></i>Guardar</button>
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
