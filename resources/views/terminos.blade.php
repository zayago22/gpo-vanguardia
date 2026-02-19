<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ config('seo.pages.terminos.meta_description', 'Términos y Condiciones de Grupo Vanguardia') }}">
    <title>{{ config('seo.pages.terminos.title', 'Términos y Condiciones — GPO Vanguardia') }}</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    @include('partials.seo-head', ['seoPage' => 'terminos'])

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #4338CA;
            --primary-light: #6366F1;
            --primary-dark: #3730A3;
            --secondary: #818CF8;
            --dark: #1E1B4B;
            --gray-50: #F8FAFC;
            --gray-100: #F1F5F9;
            --gray-200: #E2E8F0;
            --gray-500: #64748B;
            --gray-600: #475569;
            --gray-700: #334155;
            --white: #FFFFFF;
            --gradient: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 50%, var(--secondary) 100%);
        }

        * { box-sizing: border-box; }
        body {
            font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--gray-700);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* ===== NAVBAR ===== */
        .navbar-custom {
            background: var(--white);
            padding: 12px 0;
            transition: all 0.3s ease;
            border-bottom: 3px solid var(--primary);
        }
        .navbar-custom.scrolled { box-shadow: 0 2px 20px rgba(0,0,0,0.08); }
        .navbar-custom .navbar-brand img { height: 40px; }
        .navbar-custom .nav-link {
            color: var(--gray-700) !important;
            font-weight: 500;
            font-size: 14px;
            padding: 8px 16px !important;
            transition: color 0.3s;
        }
        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active { color: var(--primary) !important; }
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

        /* ===== PAGE HEADER ===== */
        .page-header {
            background: var(--gradient);
            padding: 140px 0 70px;
            position: relative;
        }
        .page-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50px;
            background: var(--white);
            clip-path: ellipse(55% 100% at 50% 100%);
        }
        .page-header h1 {
            font-size: 40px;
            font-weight: 800;
            color: var(--white);
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }
        .page-header p {
            color: rgba(255,255,255,0.75);
            font-size: 15px;
        }

        /* ===== CONTENT ===== */
        .legal-content {
            padding: 60px 0 80px;
        }
        .legal-card {
            background: var(--white);
            border-radius: 20px;
            padding: 50px;
            box-shadow: 0 6px 30px rgba(0,0,0,0.06);
            max-width: 860px;
            margin: 0 auto;
        }
        .legal-card h2 {
            font-size: 22px;
            font-weight: 700;
            color: var(--dark);
            margin-top: 36px;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .legal-card h2 .num {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, rgba(67,56,202,0.08), rgba(99,102,241,0.12));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
            flex-shrink: 0;
        }
        .legal-card h2:first-child { margin-top: 0; }
        .legal-card p {
            font-size: 15px;
            color: var(--gray-600);
            line-height: 1.85;
            margin-bottom: 12px;
        }
        .legal-card a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }
        .legal-card a:hover { text-decoration: underline; }
        .legal-intro {
            font-size: 16px !important;
            color: var(--gray-700) !important;
            border-left: 4px solid var(--primary);
            padding-left: 20px;
            margin-bottom: 32px !important;
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
        .footer-about .footer-brand img { height: 36px; }
        .footer-about .footer-brand span {
            font-weight: 700;
            color: var(--white);
            font-size: 18px;
        }
        .footer-about p {
            color: rgba(255,255,255,0.55);
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 20px;
        }
        .footer-socials { display: flex; gap: 10px; }
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
        .footer-col ul { list-style: none; padding: 0; margin: 0; }
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
        .footer-bottom { text-align: center; }
        .footer-bottom p {
            color: rgba(255,255,255,0.4);
            font-size: 13px;
            margin-bottom: 0;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 991px) {
            .page-header { padding: 120px 0 60px; }
            .page-header h1 { font-size: 32px; }
            .legal-card { padding: 32px 24px; }
            .footer-top { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 575px) {
            .page-header h1 { font-size: 26px; }
            .footer-top { grid-template-columns: 1fr; gap: 30px; }
        }
    </style>
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#inicio">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#proposito">Misión y Visión</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Servicios</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('home') }}#servicios"><i class="fas fa-brain"></i>IA y PNL</a></li>
                            <li><a class="dropdown-item" href="{{ route('home') }}#servicios"><i class="fas fa-shield-alt"></i>Ciberseguridad</a></li>
                            <li><a class="dropdown-item" href="{{ route('home') }}#servicios"><i class="fas fa-cogs"></i>BPO</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('cctv') }}"><i class="fas fa-video"></i>CCTV</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#valores">Valores</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#contacto">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ===== PAGE HEADER ===== -->
    <section class="page-header">
        <div class="container">
            <h1>Términos y Condiciones</h1>
            <p>Última actualización: 30 de agosto de 2024</p>
        </div>
    </section>

    <!-- ===== CONTENT ===== -->
    <section class="legal-content">
        <div class="container">
            <div class="legal-card">
                <p class="legal-intro">
                    Bienvenido a <strong>Grupo Vanguardia en Información y Conocimiento S.A. de C.V.</strong> Al acceder y utilizar nuestro sitio web, aceptas estar sujeto a los siguientes Términos y Condiciones. Si no estás de acuerdo con alguno de estos términos, por favor, abstente de utilizar nuestro sitio.
                </p>

                <h2><span class="num">1</span> Aceptación de los Términos</h2>
                <p>Al acceder y utilizar el sitio web de Grupo Vanguardia en Información y Conocimiento S.A. de C.V., aceptas cumplir con estos Términos y Condiciones, así como con todas las leyes y regulaciones aplicables. Nos reservamos el derecho de modificar estos Términos y Condiciones en cualquier momento, por lo que te recomendamos revisarlos periódicamente.</p>

                <h2><span class="num">2</span> Uso del Sitio</h2>
                <p>El contenido y los materiales disponibles en este sitio son proporcionados para tu información general y no deben ser interpretados como asesoramiento profesional. El uso del sitio es bajo tu propio riesgo. No garantizamos que el sitio esté libre de errores o que el acceso al sitio sea ininterrumpido.</p>

                <h2><span class="num">3</span> Propiedad Intelectual</h2>
                <p>Todos los contenidos, incluidas las imágenes, textos, gráficos, logotipos y otros materiales disponibles en el sitio, son propiedad de Grupo Vanguardia en Información y Conocimiento S.A. de C.V. o de terceros licenciantes. Está prohibido copiar, reproducir, distribuir o utilizar cualquier contenido sin el permiso previo por escrito de Grupo Vanguardia en Información y Conocimiento S.A. de C.V.</p>

                <h2><span class="num">4</span> Enlaces a Sitios de Terceros</h2>
                <p>El sitio puede contener enlaces a sitios web de terceros. Estos enlaces se proporcionan únicamente para tu conveniencia. Grupo Vanguardia en Información y Conocimiento S.A. de C.V. no se responsabiliza del contenido o de la exactitud de la información en los sitios de terceros, ni respalda ningún producto o servicio disponible en dichos sitios.</p>

                <h2><span class="num">5</span> Limitación de Responsabilidad</h2>
                <p>Grupo Vanguardia en Información y Conocimiento S.A. de C.V. no será responsable por ningún daño directo, indirecto, incidental, especial o consecuente que resulte del uso o la imposibilidad de uso del sitio, o de cualquier información, servicio o producto adquirido a través del sitio.</p>

                <h2><span class="num">6</span> Privacidad</h2>
                <p>Tu privacidad es importante para nosotros. Consulta nuestra Política de Privacidad para obtener más información sobre cómo recopilamos, utilizamos y protegemos tu información personal.</p>

                <h2><span class="num">7</span> Ley Aplicable</h2>
                <p>Estos Términos y Condiciones se regirán e interpretarán de acuerdo con las leyes de México. Cualquier disputa que surja en relación con estos términos se resolverá en los tribunales competentes de México.</p>

                <h2><span class="num">8</span> Contacto</h2>
                <p>Si tienes alguna pregunta o inquietud acerca de estos Términos y Condiciones, puedes contactarnos a través de <a href="mailto:soporte@cgpvc.com">soporte@cgpvc.com</a>.</p>
            </div>
        </div>
    </section>

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
                    @if($redes->count() > 0)
                    <div class="footer-socials">
                        @foreach($redes as $red)
                            <a href="{{ $red->url }}" target="_blank" rel="noopener" title="{{ $red->nombre }}"><i class="{{ $red->icono }}"></i></a>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="footer-col">
                    <h6>Navegación</h6>
                    <ul>
                        <li><a href="{{ route('home') }}#inicio">Inicio</a></li>
                        <li><a href="{{ route('home') }}#proposito">Misión y Visión</a></li>
                        <li><a href="{{ route('home') }}#servicios">Servicios</a></li>
                        <li><a href="{{ route('home') }}#valores">Valores</a></li>
                        <li><a href="{{ route('home') }}#contacto">Contacto</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h6>Servicios</h6>
                    <ul>
                        <li><a href="{{ route('home') }}#servicios">Inteligencia Artificial</a></li>
                        <li><a href="{{ route('home') }}#servicios">Ciberseguridad</a></li>
                        <li><a href="{{ route('home') }}#servicios">BPO</a></li>
                        <li><a href="{{ route('cctv') }}">CCTV</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h6>Contacto</h6>
                    <ul>
                        <li><a href="tel:5585263542"><i class="fas fa-phone-alt"></i>55 8526 3542</a></li>
                        <li><a href="mailto:soporte@cgpvc.com"><i class="fas fa-envelope"></i>soporte@cgpvc.com</a></li>
                        <li><a href="{{ route('home') }}#contacto"><i class="fas fa-map-marker-alt"></i>CDMX, México</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Grupo Vanguardia. Todos los derechos reservados. &middot; <a href="{{ route('terminos') }}" style="color: rgba(255,255,255,0.55); text-decoration: none;">Términos y Condiciones</a></p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('mainNav');
            nav.classList.toggle('scrolled', window.scrollY > 50);
        });
    </script>
</body>
</html>
