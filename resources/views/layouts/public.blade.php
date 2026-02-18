<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'GPO Vanguardia')</title>
    <meta name="description" content="@yield('description', 'Grupo Vanguardia: líderes en contact center, BPO y call center outsourcing en CDMX.')">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #4338CA;
            --primary-light: #6366F1;
            --primary-dark: #3730A3;
            --secondary: #818CF8;
            --dark: #1E1B4B;
            --gray-200: #E2E8F0;
            --gray-700: #334155;
            --white: #FFFFFF;
        }
        body { font-family: 'Montserrat', sans-serif; }
        
        /* ===== NAVBAR ===== */
        .navbar-custom {
            background: var(--white);
            padding: 12px 0;
            transition: all 0.3s ease;
            border-bottom: 3px solid var(--primary);
        }
        .navbar-custom.scrolled {
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        }
        .navbar-custom .navbar-brand img {
            height: 40px;
        }
        .navbar-custom .nav-link {
            color: var(--gray-700) !important;
            font-weight: 500;
            font-size: 14px;
            padding: 8px 16px !important;
            transition: color 0.3s;
        }
        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            color: var(--primary) !important;
        }
        .navbar-custom .dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.12);
            padding: 8px 0;
            margin-top: 8px;
        }
        .navbar-custom .dropdown-item {
            font-size: 14px;
            font-weight: 500;
            color: var(--gray-700);
            padding: 10px 20px;
            transition: all 0.2s;
        }
        .navbar-custom .dropdown-item:hover {
            background: rgba(67,56,202,0.06);
            color: var(--primary);
        }
        .navbar-custom .dropdown-item i {
            width: 22px;
            color: var(--primary-light);
            margin-right: 6px;
        }

        /* ===== FOOTER ===== */
        .footer {
            background: #0F0D2E;
            padding: 60px 0 30px;
        }
        .footer-top {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            padding-bottom: 40px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            margin-bottom: 30px;
        }
        .footer-about .footer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }
        .footer-about .footer-brand img {
            height: 36px;
        }
        .footer-about .footer-brand span {
            font-weight: 700;
            color: var(--white);
            font-size: 18px;
            letter-spacing: -0.3px;
        }
        .footer-about p {
            color: rgba(255,255,255,0.55);
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 20px;
        }
        .footer-socials {
            display: flex;
            gap: 10px;
        }
        .footer-socials a {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(255,255,255,0.07);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.6);
            font-size: 16px;
            transition: all 0.3s;
            text-decoration: none;
        }
        .footer-socials a:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-2px);
        }
        .footer-col h6 {
            color: var(--white);
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }
        .footer-col ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .footer-col ul li { margin-bottom: 10px; }
        .footer-col ul li a {
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }
        .footer-col ul li a:hover { color: var(--white); }
        .footer-col ul li i {
            width: 20px;
            color: var(--primary-light);
            margin-right: 6px;
            font-size: 13px;
        }
        .footer-bottom {
            text-align: center;
        }
        .footer-bottom p {
            color: rgba(255,255,255,0.4);
            font-size: 13px;
            margin-bottom: 0;
        }
        @media (max-width: 991px) {
            .footer-top { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 575px) {
            .footer-top { grid-template-columns: 1fr; gap: 30px; }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- ===== NAVBAR ===== -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="GPO Vanguardia">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="border-color: var(--gray-200);">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ route('servicios') }}" data-bs-toggle="dropdown" aria-expanded="false">Servicios</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('servicios') }}"><i class="fas fa-cogs"></i>Todos los Servicios</a></li>
                            <li><a class="dropdown-item" href="{{ route('call-center') }}"><i class="fas fa-headset"></i>Call Center Omnicanal</a></li>
                            <li><a class="dropdown-item" href="{{ route('chatbots') }}"><i class="fas fa-robot"></i>Chat Bots y AI</a></li>
                            <li><a class="dropdown-item" href="{{ route('mesa-servicios') }}"><i class="fas fa-tools"></i>Mesa de Servicios</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('cctv') }}"><i class="fas fa-video"></i>CCTV</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('clientes') }}">Clientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contacto') }}">Contacto</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('blog.index') }}">Blog</a></li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- ===== FOOTER ===== -->
    <footer class="footer">
        <div class="container">
            <div class="footer-top">
                <div class="footer-about">
                    <div class="footer-brand">
                        <img src="{{ asset('images/logo.png') }}" alt="GPO Vanguardia">
                        <span>Grupo Vanguardia</span>
                    </div>
                    <p>Soluciones empresariales que marcan la diferencia. Líderes en BPO, IA, ciberseguridad y transformación tecnológica.</p>
                    <div class="footer-socials">
                        <a href="https://www.facebook.com/callcentergrupovanguardia" target="_blank" rel="noopener" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.linkedin.com/company/gpo-vanguardia/" target="_blank" rel="noopener" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://instagram.com/" target="_blank" rel="noopener" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="https://twitter.com/" target="_blank" rel="noopener" title="Twitter"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h6>Navegación</h6>
                    <ul>
                        <li><a href="{{ route('home') }}">Inicio</a></li>
                        <li><a href="{{ route('servicios') }}">Servicios</a></li>
                        <li><a href="{{ route('clientes') }}">Clientes</a></li>
                        <li><a href="{{ route('blog.index') }}">Blog</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h6>Servicios</h6>
                    <ul>
                        <li><a href="{{ route('call-center') }}">Call Center Omnicanal</a></li>
                        <li><a href="{{ route('chatbots') }}">Chat Bots y AI</a></li>
                        <li><a href="{{ route('mesa-servicios') }}">Mesa de Servicios</a></li>
                        <li><a href="{{ route('cctv') }}">CCTV</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h6>Contacto</h6>
                    <ul>
                        <li><a href="tel:5585263542"><i class="fas fa-phone-alt"></i>55 8526 3542</a></li>
                        <li><a href="mailto:soporte@cgpvc.com"><i class="fas fa-envelope"></i>soporte@cgpvc.com</a></li>
                        <li><a href="{{ route('contacto') }}"><i class="fas fa-map-marker-alt"></i>CDMX, México</a></li>
                        <li><a href="{{ route('aviso') }}" style="color: var(--primary-light);">Aviso de privacidad</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Grupo Vanguardia. Todos los derechos reservados. &middot; <a href="{{ route('terminos') }}" style="color: rgba(255,255,255,0.55); text-decoration: none;">Términos y Condiciones</a></p>
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('mainNav');
            nav.classList.toggle('scrolled', window.scrollY > 50);
        });
    </script>
    @yield('scripts')
</body>
</html>
