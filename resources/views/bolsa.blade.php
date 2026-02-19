@extends('layouts.public')

@section('title', 'Bolsa de empleo — GPO Vanguardia')

@section('styles')
<style>
    .bolsa-hero {
        margin-top: 70px;
        background: linear-gradient(135deg, rgba(67,56,202,0.9), rgba(99,102,241,0.9)), url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=1600&h=700&fit=crop') center/cover no-repeat;
        color: #fff;
        padding: 120px 0 80px;
        position: relative;
        overflow: hidden;
    }
    .bolsa-hero h1 {
        font-weight: 800;
        font-size: 42px;
        letter-spacing: -0.6px;
    }
    .bolsa-hero p {
        font-size: 18px;
        color: rgba(255,255,255,0.9);
    }
    .bolsa-section {
        padding: 80px 0;
        background: linear-gradient(135deg, rgba(67,56,202,0.04), rgba(99,102,241,0.05));
    }
    .bolsa-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 12px 40px rgba(0,0,0,0.08);
        padding: 32px;
        border: 1px solid #e5e7eb;
    }
    .bolsa-card h3 {
        font-size: 26px;
        font-weight: 800;
        color: #1e1b4b;
        margin-bottom: 8px;
        letter-spacing: -0.4px;
    }
    .bolsa-card p.lead {
        color: #475569;
        font-size: 16px;
        margin-bottom: 24px;
    }
    .bolsa-card label {
        font-weight: 600;
        color: #334155;
        font-size: 14px;
    }
    .bolsa-card .form-control {
        border-radius: 12px;
        border-color: #e2e8f0;
        padding: 12px 14px;
    }
    .bolsa-card .form-control:focus {
        box-shadow: 0 0 0 3px rgba(67,56,202,0.15);
        border-color: #4338ca;
    }
    .bolsa-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(67,56,202,0.08);
        color: #4338ca;
        padding: 8px 14px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 13px;
        margin-bottom: 16px;
    }
    .btn-bolsa {
        background: linear-gradient(135deg, #4338CA, #6366F1);
        color: #fff;
        border: none;
        padding: 12px 18px;
        border-radius: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-bolsa:hover { color: #fff; opacity: 0.95; }
    .bolsa-note {
        font-size: 13px;
        color: #475569;
    }
    .alert-bolsa { border-radius: 12px; }
</style>
@endsection

@section('content')
    <section class="bolsa-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1>Bolsa de empleo</h1>
                    <p>Únete al equipo de Grupo Vanguardia y ayuda a transformar empresas con IA, ciberseguridad y operaciones BPO de alto nivel.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bolsa-section">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-5">
                    <span class="bolsa-badge"><i class="fas fa-briefcase"></i> Bolsa de empleo</span>
                    <h3>Comparte tu perfil profesional</h3>
                    <p class="lead">Cuéntanos de ti y adjunta tu CV. Nuestro equipo de talento evaluará tu experiencia y te contactará si hay un match con nuestras vacantes.</p>
                    <p class="bolsa-note"><i class="fas fa-info-circle me-1"></i> Aceptamos CV en PDF, DOC o DOCX (máx. 5 MB).</p>
                </div>
                <div class="col-lg-7">
                    <div class="bolsa-card">
                        @if(session('bolsa_success'))
                            <div class="alert alert-success alert-bolsa mb-3">{{ session('bolsa_success') }}</div>
                        @endif
                        @if($errors->bolsa?->any())
                            <div class="alert alert-danger alert-bolsa mb-3">
                                <strong>Corrige los siguientes campos:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->bolsa->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('bolsa.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nombre *</label>
                                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Apellido *</label>
                                    <input type="text" name="apellido" class="form-control" value="{{ old('apellido') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Correo *</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Teléfono</label>
                                    <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}" placeholder="Opcional">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">CV *</label>
                                    <input type="file" name="cv" class="form-control" accept=".pdf,.doc,.docx" required>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn-bolsa">
                                        <i class="fas fa-paper-plane"></i> Enviar aplicación
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
