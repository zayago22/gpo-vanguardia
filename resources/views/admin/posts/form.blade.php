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
                        <input type="text" class="form-control" name="titulo" id="titulo" value="{{ old('titulo', $post->titulo ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug (URL amigable para SEO)</label>
                        <div class="input-group">
                            <span class="input-group-text" style="font-size:13px">/blog/</span>
                            <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug', $post->slug ?? '') }}" placeholder="Se genera automáticamente del título">
                        </div>
                        <small class="text-muted">Déjalo vacío para generarlo automáticamente. Solo letras, números y guiones.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Meta descripción SEO <small class="text-muted">(máx. 160 caracteres)</small></label>
                        <textarea class="form-control" name="meta_description" rows="2" maxlength="160" id="metaDesc" placeholder="Descripción que aparecerá en Google">{{ old('meta_description', $post->meta_description ?? '') }}</textarea>
                        <small class="text-muted"><span id="metaDescCount">0</span>/160 caracteres</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Extracto</label>
                        <textarea class="form-control" name="extracto" rows="2" maxlength="500">{{ old('extracto', $post->extracto ?? '') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Categoría</label>
                        <input type="text" class="form-control" name="categoria" value="{{ old('categoria', $post->categoria ?? '') }}" maxlength="100" placeholder="Ej. Ciberseguridad, IA, BPO">
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
                            <input class="form-check-input" type="checkbox" name="publicado" value="1" id="publicado" {{ old('publicado', $post->publicado ?? true) ? 'checked' : '' }}>
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

@section('scripts')
<script>
// Auto-generate slug from title (only if slug field is empty)
const tituloInput = document.getElementById('titulo');
const slugInput = document.getElementById('slug');
let slugManuallyEdited = slugInput.value.trim() !== '';

slugInput.addEventListener('input', function() {
    slugManuallyEdited = this.value.trim() !== '';
});

tituloInput.addEventListener('input', function() {
    if (!slugManuallyEdited) {
        slugInput.value = this.value
            .toLowerCase()
            .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .replace(/^-|-$/g, '');
    }
});

// Meta description character counter
const metaDesc = document.getElementById('metaDesc');
const metaDescCount = document.getElementById('metaDescCount');
if (metaDesc) {
    metaDescCount.textContent = metaDesc.value.length;
    metaDesc.addEventListener('input', function() {
        metaDescCount.textContent = this.value.length;
        metaDescCount.style.color = this.value.length > 155 ? '#dc3545' : '';
    });
}
</script>
@endsection
