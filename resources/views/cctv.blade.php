<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Servicio de Sistemas de Seguridad CCTV — Videovigilancia, cámaras con sensores, monitoreo continuo e inteligencia artificial aplicada al vídeo.">
    <meta name="keywords" content="CCTV, videovigilancia, seguridad, cámaras, monitoreo, analítica de vídeo, RFID">
    <meta property="og:title" content="CCTV — GPO Vanguardia">
    <meta property="og:description" content="Servicio integral de sistemas de seguridad CCTV con tecnología de vanguardia.">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">
    <title>{{ config('seo.pages.cctv.title', 'CCTV — GPO Vanguardia') }}</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.seo-head', ['seoPage' => 'cctv'])

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
            --accent: #A78BFA;
            --dark: #1E1B4B;
            --gray-50: #F8FAFC;
            --gray-100: #F1F5F9;
            --gray-200: #E2E8F0;
            --gray-400: #94A3B8;
            --gray-500: #64748B;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1E293B;
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
        .navbar-custom.scrolled {
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        }
        .navbar-custom .navbar-brand img { height: 40px; }
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

        /* ===== HERO CCTV ===== */
        .hero-cctv {
            background: linear-gradient(135deg, rgba(30,27,75,0.92), rgba(67,56,202,0.85)),
                        url('https://images.unsplash.com/photo-1557597774-9d273605dfa9?w=1600&h=800&fit=crop') center/cover no-repeat;
            padding: 160px 0 100px;
            position: relative;
        }
        .hero-cctv::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: var(--white);
            clip-path: ellipse(55% 100% at 50% 100%);
        }
        .hero-cctv h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 48px;
            font-weight: 800;
            color: var(--white);
            line-height: 1.15;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }
        .hero-cctv .badge-tag {
            display: inline-block;
            background: rgba(255,255,255,0.15);
            color: var(--white);
            font-size: 13px;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: 50px;
            margin-bottom: 20px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .hero-cctv p {
            color: rgba(255,255,255,0.85);
            font-size: 18px;
            max-width: 560px;
            line-height: 1.7;
        }
        .btn-hero {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--white);
            color: var(--primary);
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 15px;
            text-decoration: none;
            transition: all 0.3s;
            margin-top: 12px;
        }
        .btn-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.2);
            color: var(--primary-dark);
        }

        /* ===== SECTIONS ===== */
        .section { padding: 80px 0; }
        .section-gray { background: var(--gray-50); }
        .section-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 36px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
            letter-spacing: -0.5px;
            position: relative;
            display: inline-block;
        }
        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--primary);
            margin: 12px auto 0;
            border-radius: 2px;
        }
        .section-subtitle {
            color: var(--gray-500);
            font-size: 16px;
            max-width: 580px;
            margin: 12px auto 0;
        }

        /* ===== CCTV SERVICES GRID ===== */
        .cctv-services {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 32px;
        }
        .cctv-service-card {
            background: var(--white);
            border-radius: 20px;
            padding: 40px 32px;
            box-shadow: 0 6px 24px rgba(0,0,0,0.06);
            border: 1px solid transparent;
            transition: all 0.4s;
            position: relative;
            overflow: hidden;
        }
        .cctv-service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient);
            opacity: 0;
            transition: opacity 0.4s;
        }
        .cctv-service-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(67,56,202,0.12);
        }
        .cctv-service-card:hover::before { opacity: 1; }
        .cctv-service-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, rgba(67,56,202,0.08), rgba(99,102,241,0.12));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--primary);
            margin-bottom: 20px;
            transition: all 0.4s;
        }
        .cctv-service-card:hover .cctv-service-icon {
            background: var(--gradient);
            color: var(--white);
        }
        .cctv-service-card h4 {
            font-size: 20px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 12px;
        }
        .cctv-service-card p {
            font-size: 15px;
            color: var(--gray-600);
            line-height: 1.8;
            margin-bottom: 0;
        }

        /* ===== EQUIPAMIENTO ===== */
        .equipo-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }
        .equipo-item {
            background: var(--white);
            border-radius: 12px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            font-weight: 500;
            color: var(--gray-700);
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
            border: 1px solid var(--gray-100);
            transition: all 0.3s;
        }
        .equipo-item:hover {
            border-color: var(--primary-light);
            box-shadow: 0 4px 15px rgba(67,56,202,0.08);
        }
        .equipo-item i {
            color: var(--primary);
            font-size: 16px;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        /* ===== RFID SECTIONS ===== */
        .rfid-row {
            display: flex;
            align-items: center;
            gap: 60px;
            margin-bottom: 60px;
        }
        .rfid-row.reverse { flex-direction: row-reverse; }
        .rfid-row:last-child { margin-bottom: 0; }
        .rfid-content { flex: 1; }
        .rfid-content h3 {
            font-size: 26px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 16px;
            letter-spacing: -0.3px;
        }
        .rfid-content p {
            font-size: 15px;
            color: var(--gray-600);
            line-height: 1.8;
        }
        .rfid-content ul {
            list-style: none;
            padding: 0;
            margin: 16px 0 0;
        }
        .rfid-content ul li {
            padding: 6px 0;
            font-size: 15px;
            color: var(--gray-600);
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .rfid-content ul li i {
            color: var(--primary);
            margin-top: 4px;
            flex-shrink: 0;
        }
        .rfid-visual {
            flex: 1;
            background: var(--gradient);
            border-radius: 20px;
            padding: 50px 40px;
            text-align: center;
            color: var(--white);
            min-height: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .rfid-visual i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.9;
        }
        .rfid-visual h4 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .rfid-visual p {
            opacity: 0.85;
            font-size: 14px;
        }

        /* ===== CTA ===== */
        .cta-section {
            background: var(--dark);
            padding: 80px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .cta-section::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            background: rgba(99,102,241,0.1);
        }
        .cta-section h2 {
            color: var(--white);
            font-size: 34px;
            font-weight: 700;
            margin-bottom: 16px;
            letter-spacing: -0.3px;
            position: relative;
            z-index: 1;
        }
        .cta-section p {
            color: rgba(255,255,255,0.65);
            font-size: 16px;
            max-width: 500px;
            margin: 0 auto 30px;
            position: relative;
            z-index: 1;
        }
        .btn-cta {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--gradient);
            color: var(--white);
            padding: 16px 36px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 16px;
            text-decoration: none;
            transition: all 0.3s;
            position: relative;
            z-index: 1;
        }
        .btn-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(67,56,202,0.4);
            color: var(--white);
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
        .footer-bottom { text-align: center; }
        .footer-bottom p {
            color: rgba(255,255,255,0.4);
            font-size: 13px;
            margin-bottom: 0;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 991px) {
            .hero-cctv { padding: 130px 0 80px; }
            .hero-cctv h1 { font-size: 36px; }
            .cctv-services { grid-template-columns: 1fr; }
            .equipo-grid { grid-template-columns: repeat(2, 1fr); }
            .rfid-row, .rfid-row.reverse {
                flex-direction: column;
                gap: 30px;
            }
            .footer-top { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 767px) {
            .hero-cctv h1 { font-size: 30px; }
            .hero-cctv::after { height: 40px; }
            .section { padding: 60px 0; }
            .section-title { font-size: 28px; }
            .equipo-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 575px) {
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
                        <a class="nav-link dropdown-toggle active" href="#" data-bs-toggle="dropdown" aria-expanded="false">Servicios</a>
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

    <!-- ===== HERO ===== -->
    <section class="hero-cctv">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <span class="badge-tag"><i class="fas fa-video me-2"></i>Servicio Especializado</span>
                    <h1>Sistema de Seguridad<br>CCTV</h1>
                    <p>Servicio integral de sistemas de videovigilancia con tecnología de punta, cámaras inteligentes y monitoreo continuo para la protección total de su empresa.</p>
                    <a href="{{ route('home') }}#contacto" class="btn-hero">
                        Solicitar Cotización <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SERVICIOS CCTV ===== -->
    <section class="section" id="servicios-cctv">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Servicio Sistema de Seguridad CCTV</h2>
                <p class="section-subtitle">Soluciones integrales de videovigilancia para empresas e instituciones</p>
            </div>
            <div class="cctv-services">
                <div class="cctv-service-card">
                    <div class="cctv-service-icon">
                        <i class="fas fa-video"></i>
                    </div>
                    <h4>Sistema de Videovigilancia</h4>
                    <p>Posicionamiento de manera estratégica de cámaras fijas y móviles para una cobertura total de sus instalaciones con la más alta calidad de imagen.</p>
                </div>
                <div class="cctv-service-card">
                    <div class="cctv-service-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h4>Cámaras con Sensores de Alarma</h4>
                    <p>Sistema integral de grabación, con alertas sonoras y visuales que permiten una respuesta inmediata ante cualquier evento de seguridad.</p>
                </div>
                <div class="cctv-service-card">
                    <div class="cctv-service-icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <h4>Monitoreo Continuo</h4>
                    <p>Implementación del Sistema de CCTV con integración en los sistemas de alarmas externas para un monitoreo 24/7 de sus instalaciones.</p>
                </div>
                <div class="cctv-service-card">
                    <div class="cctv-service-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h4>Analítica de Vídeo Inteligente</h4>
                    <p>Software de algoritmos para analítica de vídeo basada en Inteligencia Artificial, detección de patrones y comportamiento en tiempo real.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== EQUIPAMIENTO ===== -->
    <section class="section section-gray">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Equipamiento</h2>
                <p class="section-subtitle">Tecnología profesional de última generación para su sistema de seguridad</p>
            </div>
            <div class="equipo-grid">
                <div class="equipo-item">
                    <i class="fas fa-camera"></i> Cámaras fijas
                </div>
                <div class="equipo-item">
                    <i class="fas fa-video"></i> Cámaras móviles
                </div>
                <div class="equipo-item">
                    <i class="fas fa-search-plus"></i> Lentes varifocal
                </div>
                <div class="equipo-item">
                    <i class="fas fa-shield-alt"></i> Carcazas antivandálicas para cámaras
                </div>
                <div class="equipo-item">
                    <i class="fas fa-expand-arrows-alt"></i> Soportes para video cámaras
                </div>
                <div class="equipo-item">
                    <i class="fas fa-train"></i> Cámaras de riel
                </div>
                <div class="equipo-item">
                    <i class="fas fa-server"></i> Equipo de administración y grabación digital
                </div>
                <div class="equipo-item">
                    <i class="fas fa-tv"></i> Plataformas para la visualización
                </div>
                <div class="equipo-item">
                    <i class="fas fa-laptop"></i> Equipos de cómputo
                </div>
                <div class="equipo-item">
                    <i class="fas fa-hdd"></i> Unidades de disco de respaldo
                </div>
                <div class="equipo-item">
                    <i class="fas fa-cloud"></i> Backup en la nube
                </div>
                <div class="equipo-item">
                    <i class="fas fa-car-battery"></i> Equipos de respaldo de energía
                </div>
                <div class="equipo-item">
                    <i class="fas fa-desktop"></i> Monitores LCD de 17" y 21"
                </div>
                <div class="equipo-item">
                    <i class="fas fa-building"></i> Centro de trabajo
                </div>
                <div class="equipo-item">
                    <i class="fas fa-user-shield"></i> Personal de monitoreo
                </div>
            </div>
        </div>
    </section>

    <!-- ===== RFID ===== -->
    <section class="section" id="rfid">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Soluciones RFID</h2>
                <p class="section-subtitle">Tecnología de identificación por radiofrecuencia para control total de activos</p>
            </div>

            <!-- Control de herramientas -->
            <div class="rfid-row">
                <div class="rfid-content">
                    <h3>Control de Herramientas y Laptops</h3>
                    <p>La solución para el control de herramientas y laptops diseñada por ITS RFID le permitirá tener un control total de las herramientas de sus equipos de trabajo.</p>
                    <p>Mediante la colocación de TAGS RFID especialmente diseñados, tendrá un registro exacto de la entrega y recepción de herramientas, equipos pendientes de devolución, maquinaria en reparación así como un inventario preciso de sus existencias.</p>
                    <p>Únicamente el administrador del sistema podrá autorizar la salida del equipo. En caso de no contar con esta autorización, una alarma alertará de la salida.</p>
                </div>
                <div class="rfid-visual">
                    <i class="fas fa-tools"></i>
                    <h4>Control Total</h4>
                    <p>Tags RFID para herramientas, laptops y equipos</p>
                </div>
            </div>

            <!-- Inventario de activos -->
            <div class="rfid-row reverse">
                <div class="rfid-content">
                    <h3>Inventario de Activos RFID</h3>
                    <p>Soluciones diseñadas a medida para cada cliente que le permiten beneficiarse de las ventajas de la tecnología RFID en el Control de Activos e Inventarios:</p>
                    <ul>
                        <li><i class="fas fa-check-circle"></i>99.9% de exactitud en el inventario</li>
                        <li><i class="fas fa-check-circle"></i>60 a 80% de reducción en la falta de existencias</li>
                        <li><i class="fas fa-check-circle"></i>Recuentos de 75 a 92% más rápidos</li>
                        <li><i class="fas fa-check-circle"></i>Aumento de las ventas y mejora de la reposición</li>
                        <li><i class="fas fa-check-circle"></i>Reducción significativa de costos</li>
                    </ul>
                    <p>ITS le asesora sobre el hardware RFID más adecuado para su proyecto y desarrolla software fácil de integrar en los sistemas existentes en su empresa.</p>
                </div>
                <div class="rfid-visual">
                    <i class="fas fa-boxes-stacked"></i>
                    <h4>Inventario Inteligente</h4>
                    <p>99.9% de exactitud garantizada</p>
                </div>
            </div>

            <!-- Control de armas -->
            <div class="rfid-row">
                <div class="rfid-content">
                    <h3>Control de Armas RFID</h3>
                    <p>Soluciones diseñadas para el control en la entrega de armamento y rápidos inventarios del mismo. ITS-RFID ha diseñado software para:</p>
                    <ul>
                        <li><i class="fas fa-check-circle"></i>Control en la entrega y recepción</li>
                        <li><i class="fas fa-check-circle"></i>Inventarios de armería</li>
                        <li><i class="fas fa-check-circle"></i>Software de Administración</li>
                        <li><i class="fas fa-check-circle"></i>Software de Seguridad</li>
                    </ul>
                </div>
                <div class="rfid-visual">
                    <i class="fas fa-shield-halved"></i>
                    <h4>Armería Segura</h4>
                    <p>Control total de armamento</p>
                </div>
            </div>

            <!-- Acceso a eventos -->
            <div class="rfid-row reverse">
                <div class="rfid-content">
                    <h3>Acceso a Eventos RFID</h3>
                    <p>Identifique a todas las personas que entran o salen de su evento, feria o congreso. Mediante etiquetas RFID colocadas en acreditaciones o brazaletes, el sistema registrará en tiempo real la entrada de sus invitados.</p>
                    <p>El software dispone de amplias funcionalidades de altas y bajas de invitados, completos reportes de asistencia por evento, monitoreo en tiempo real de las entradas y salidas, todo mediante interfaces intuitivas y amigables.</p>
                </div>
                <div class="rfid-visual">
                    <i class="fas fa-ticket"></i>
                    <h4>Eventos Inteligentes</h4>
                    <p>Control de acceso en tiempo real</p>
                </div>
            </div>

            <!-- Acceso vehicular -->
            <div class="rfid-row">
                <div class="rfid-content">
                    <h3>Acceso Vehicular RFID</h3>
                    <p>Mediante la colocación de etiquetas o tarjetas RFID en el parabrisas de los vehículos, el software le permite registrar de manera automática las entradas y salidas así como accionar la barrera a todos los vehículos con acceso autorizado.</p>
                    <p>Con distancias de lectura de hasta 12 metros que le permiten anticipar la apertura de la barrera sin detener su vehículo.</p>
                </div>
                <div class="rfid-visual">
                    <i class="fas fa-car"></i>
                    <h4>Acceso Vehicular</h4>
                    <p>Lectura hasta 12 metros de distancia</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CTA ===== -->
    <section class="cta-section">
        <div class="container">
            <h2>¿Listo para proteger su empresa?</h2>
            <p>Contáctenos para una asesoría personalizada sobre nuestras soluciones de CCTV y RFID</p>
            <a href="{{ route('home') }}#contacto" class="btn-cta">
                Solicitar Asesoría <i class="fas fa-arrow-right"></i>
            </a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('mainNav');
            nav.classList.toggle('scrolled', window.scrollY > 50);
        });
    </script>
</body>
</html>
