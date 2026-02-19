<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — GPO Vanguardia</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Montserrat', sans-serif; }
        body { background: #F1F5F9; }
        .sidebar {
            background: #1E1B4B;
            min-height: 100vh;
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            transition: transform 0.3s;
        }
        .sidebar-brand {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-brand img { height: 36px; }
        .sidebar-brand span { color: #fff; font-weight: 700; font-size: 14px; margin-left: 10px; }
        .sidebar-nav { padding: 16px 0; }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 20px;
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-left: 3px solid transparent;
            transition: all 0.2s;
        }
        .sidebar-link:hover, .sidebar-link.active {
            color: #fff;
            background: rgba(255,255,255,0.08);
            border-left-color: #818CF8;
        }
        .sidebar-link i { width: 20px; text-align: center; font-size: 15px; }
        .main-content { margin-left: 260px; padding: 24px; min-height: 100vh; }
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        .topbar h1 { font-size: 24px; font-weight: 700; color: #1E293B; margin: 0; }
        .card-admin {
            background: #fff;
            border-radius: 12px;
            border: 1px solid #E2E8F0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        .card-admin .card-body { padding: 24px; }
        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #E2E8F0;
            text-align: center;
        }
        .stat-card .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            font-size: 20px;
        }
        .stat-card h3 { font-size: 28px; font-weight: 700; margin-bottom: 4px; color: #1E293B; }
        .stat-card p { font-size: 13px; color: #64748B; margin: 0; }
        .btn-primary-admin {
            background: linear-gradient(135deg, #4338CA, #6366F1);
            border: none;
            color: #fff;
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
        }
        .btn-primary-admin:hover { background: linear-gradient(135deg, #3730A3, #4338CA); color: #fff; }
        .table th { font-size: 12px; text-transform: uppercase; color: #64748B; font-weight: 600; }
        .table td { font-size: 14px; vertical-align: middle; }
        .badge-activo { background: #DCFCE7; color: #166534; font-size: 12px; padding: 4px 10px; border-radius: 20px; }
        .badge-inactivo { background: #FEE2E2; color: #991B1B; font-size: 12px; padding: 4px 10px; border-radius: 20px; }
        .form-label { font-size: 13px; font-weight: 600; color: #334155; }
        .form-control, .form-select { border-radius: 8px; border: 1px solid #E2E8F0; font-size: 14px; }
        .form-control:focus, .form-select:focus { border-color: #6366F1; box-shadow: 0 0 0 3px rgba(99,102,241,0.1); }
        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand d-flex align-items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <span>GPO Vanguardia</span>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="{{ route('admin.servicios.index') }}" class="sidebar-link {{ request()->routeIs('admin.servicios.*') ? 'active' : '' }}">
                <i class="fas fa-cogs"></i> Servicios
            </a>
            <a href="{{ route('admin.posts.index') }}" class="sidebar-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i> Blog / Posts
            </a>
            <a href="{{ route('admin.galeria.index') }}" class="sidebar-link {{ request()->routeIs('admin.galeria.*') ? 'active' : '' }}">
                <i class="fas fa-images"></i> Galería
            </a>
            <a href="{{ route('admin.testimonios.index') }}" class="sidebar-link {{ request()->routeIs('admin.testimonios.*') ? 'active' : '' }}">
                <i class="fas fa-quote-right"></i> Testimonios
            </a>
            <a href="{{ route('admin.valores.index') }}" class="sidebar-link {{ request()->routeIs('admin.valores.*') ? 'active' : '' }}">
                <i class="fas fa-gem"></i> Valores
            </a>
            <a href="{{ route('admin.redes-sociales.index') }}" class="sidebar-link {{ request()->routeIs('admin.redes-sociales.*') ? 'active' : '' }}">
                <i class="fas fa-share-alt"></i> Redes Sociales
            </a>
            <a href="{{ route('admin.contactos.index') }}" class="sidebar-link {{ request()->routeIs('admin.contactos.*') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i> Contactos
                @php $noLeidos = \App\Models\Contact::noLeidos()->count(); @endphp
                @if($noLeidos > 0)
                    <span class="badge bg-danger rounded-pill ms-auto">{{ $noLeidos }}</span>
                @endif
            </a>
            <a href="{{ route('admin.webhooks.index') }}" class="sidebar-link {{ request()->routeIs('admin.webhooks.*') ? 'active' : '' }}">
                <i class="fas fa-plug"></i> Webhooks
            </a>
            <hr style="border-color: rgba(255,255,255,0.1); margin: 12px 20px;">
            <a href="{{ route('home') }}" class="sidebar-link" target="_blank">
                <i class="fas fa-external-link-alt"></i> Ver Sitio
            </a>
            <form method="POST" action="{{ route('logout') }}" class="px-3 mt-2">
                @csrf
                <button type="submit" class="sidebar-link w-100 border-0 bg-transparent text-start" style="cursor:pointer;">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <div class="topbar">
            <div>
                <button class="btn btn-sm btn-outline-secondary d-lg-none me-2" onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="d-inline">@yield('title', 'Dashboard')</h1>
            </div>
            <div>
                <span class="text-muted" style="font-size: 13px;">
                    <i class="fas fa-user me-1"></i> {{ Auth::user()->name }}
                </span>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px; font-size: 14px;">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 10px; font-size: 14px;">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 10px; font-size: 14px;">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
