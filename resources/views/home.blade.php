<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Grupo Vanguardia - Soluciones empresariales que marcan la diferencia. Líderes en BPO, IA, ciberseguridad y transformación tecnológica.">
    <meta name="keywords" content="BPO, inteligencia artificial, ciberseguridad, outsourcing, CDMX, tecnología empresarial">
    <meta property="og:title" content="GPO Vanguardia — Soluciones Empresariales">
    <meta property="og:description" content="Líderes en BPO y transformación tecnológica con servicios certificados para el crecimiento de su empresa.">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">
    <title>GPO Vanguardia — Soluciones Empresariales</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

        /* ===== HERO ===== */
        .hero {
            background: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1600&h=800&fit=crop') center/cover no-repeat;
            padding: 140px 0 120px;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(55, 48, 163, 0.82);
        }
        .hero::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 80px;
            background: var(--white);
            border-radius: 50% 50% 0 0 / 100% 100% 0 0;
        }
        .hero .container {
            position: relative;
            z-index: 2;
        }
        .hero h1 {
            font-family: 'Montserrat', sans-serif;
            font-style: normal;
            font-size: 52px;
            font-weight: 800;
            color: var(--white);
            line-height: 1.15;
            margin-bottom: 24px;
        }
        .hero p {
            color: rgba(255,255,255,0.85);
            font-size: 16px;
            line-height: 1.7;
            max-width: 600px;
        }
        .hero .lead {
            color: var(--white);
            font-size: 18px;
            font-weight: 400;
            line-height: 1.6;
        }
        .hero .sub-lead {
            color: rgba(255,255,255,0.65);
            font-size: 15px;
        }
        .btn-hero {
            background: var(--white);
            color: var(--primary);
            border: none;
            padding: 14px 32px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-hero:hover {
            background: var(--gray-100);
            color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        /* ===== SECTIONS ===== */
        .section { padding: 80px 0; }
        .section-gray { background: var(--gray-50); }
        .section-title {
            font-family: 'Montserrat', sans-serif;
            font-style: normal;
            font-size: 38px;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: var(--dark);
            margin-bottom: 8px;
        }
        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--primary);
            margin: 14px auto 0;
            border-radius: 2px;
        }
        .section-subtitle {
            font-size: 16px;
            color: var(--gray-500);
            max-width: 600px;
            margin: 16px auto 50px;
        }

        /* ===== PROPÓSITO (Misión/Visión) ===== */
        .proposito-section { background: var(--gray-50); }
        .proposito-img {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            height: 100%;
        }
        .proposito-img img {
            width: 100%;
            height: 100%;
            min-height: 480px;
            object-fit: cover;
        }
        .proposito-card {
            background: var(--white);
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            margin-bottom: 24px;
            border: 1px solid var(--gray-200);
        }
        .proposito-card-icon {
            width: 48px;
            height: 48px;
            background: rgba(67, 56, 202, 0.08);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 20px;
            margin-bottom: 14px;
        }
        .proposito-card h4 {
            font-size: 19px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 10px;
        }
        .proposito-card p {
            font-size: 15px;
            color: var(--gray-600);
            margin-bottom: 0;
            line-height: 1.7;
        }

        /* ===== CASOS DE ÉXITO ===== */
        .casos-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }
        .caso-card {
            background: var(--white);
            border-radius: 16px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            aspect-ratio: 1;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
            border: 1px solid var(--gray-200);
            transition: all 0.3s;
        }
        .caso-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }
        .caso-card img {
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
            border-radius: 12px;
        }
        @media (max-width: 767px) {
            .casos-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
        }

        /* ===== SERVICIOS ===== */
        .servicio-row {
            display: flex;
            align-items: center;
            gap: 70px;
            margin-bottom: 70px;
        }
        .servicio-row:last-child { margin-bottom: 0; }
        .servicio-row.reverse { flex-direction: row-reverse; }
        .servicio-img {
            flex: 1;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0,0,0,0.10);
        }
        .servicio-img img {
            width: 100%;
            height: 360px;
            object-fit: cover;
            display: block;
        }
        .servicio-content { flex: 1; }
        .servicio-icon {
            width: 58px;
            height: 58px;
            background: var(--primary);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 24px;
            margin-bottom: 20px;
            box-shadow: 0 8px 20px rgba(67,56,202,0.25);
        }
        .servicio-content h3 {
            font-size: 28px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 16px;
            font-family: 'Montserrat', sans-serif;
            letter-spacing: -0.3px;
        }
        .servicio-content p {
            font-size: 16px;
            color: var(--gray-600);
            line-height: 1.9;
        }
        @media (max-width: 991px) {
            .servicio-row,
            .servicio-row.reverse {
                flex-direction: column;
                gap: 30px;
            }
            .servicio-img img {
                height: 280px;
            }
        }

        /* ===== VALORES ===== */
        .valores-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 28px;
        }
        .valor-card {
            background: var(--white);
            border-radius: 20px;
            padding: 40px 28px;
            text-align: center;
            box-shadow: 0 6px 24px rgba(0,0,0,0.06);
            transition: all 0.4s ease;
            border: 1px solid transparent;
            position: relative;
            overflow: hidden;
        }
        .valor-card::before {
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
        .valor-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 40px rgba(67,56,202,0.15);
            border-color: rgba(67,56,202,0.1);
        }
        .valor-card:hover::before {
            opacity: 1;
        }
        .valor-icon {
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, rgba(67,56,202,0.08), rgba(99,102,241,0.12));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 28px;
            color: var(--primary);
            transition: all 0.4s;
        }
        .valor-card:hover .valor-icon {
            background: var(--gradient);
            color: var(--white);
            transform: scale(1.08);
        }
        .valor-card h5 {
            font-size: 18px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 10px;
            letter-spacing: -0.2px;
        }
        .valor-card p {
            font-size: 14px;
            color: var(--gray-500);
            line-height: 1.7;
            margin-bottom: 0;
        }
        @media (max-width: 991px) {
            .valores-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 575px) {
            .valores-grid { grid-template-columns: 1fr; max-width: 360px; margin: 0 auto; }
        }

        /* ===== TESTIMONIOS ===== */
        .testimonio-card {
            background: var(--white);
            border-radius: 20px;
            padding: 36px 32px;
            box-shadow: 0 6px 24px rgba(0,0,0,0.06);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            border: 1px solid transparent;
            transition: all 0.4s;
        }
        .testimonio-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 35px rgba(67,56,202,0.12);
        }
        .testimonio-card .quote-icon {
            font-size: 32px;
            color: var(--primary-light);
            opacity: 0.25;
            margin-bottom: 12px;
            line-height: 1;
        }
        .testimonio-stars {
            margin-bottom: 16px;
        }
        .testimonio-stars i {
            color: #F59E0B;
            font-size: 15px;
            margin-right: 2px;
        }
        .testimonio-text {
            font-size: 15px;
            color: var(--gray-600);
            line-height: 1.8;
            flex: 1;
            margin-bottom: 24px;
            font-style: italic;
        }
        .testimonio-author {
            display: flex;
            align-items: center;
            gap: 14px;
            padding-top: 20px;
            border-top: 1px solid var(--gray-100);
        }
        .testimonio-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: 700;
            font-size: 18px;
            flex-shrink: 0;
        }
        .testimonio-author-info strong {
            display: block;
            font-size: 15px;
            font-weight: 700;
            color: var(--dark);
        }
        .testimonio-author-info span {
            font-size: 13px;
            color: var(--gray-500);
        }

        /* ===== CONTACTO ===== */
        .contacto-section {
            background: var(--dark);
            position: relative;
            padding: 80px 0;
            overflow: hidden;
        }
        .contacto-section::before {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(99,102,241,0.08);
        }
        .contacto-section::after {
            content: '';
            position: absolute;
            bottom: -60px;
            left: -60px;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: rgba(67,56,202,0.06);
        }
        .contacto-header {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
            z-index: 1;
        }
        .contacto-header h2 {
            color: var(--white);
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }
        .contacto-header p {
            color: rgba(255,255,255,0.6);
            font-size: 16px;
            max-width: 520px;
            margin: 0 auto;
        }
        .contacto-body {
            position: relative;
            z-index: 1;
        }
        .info-cards-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 50px;
        }
        .info-card {
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(12px);
            border-radius: 16px;
            padding: 28px 24px;
            text-align: center;
            color: var(--white);
            border: 1px solid rgba(255,255,255,0.08);
            transition: all 0.3s;
        }
        .info-card:hover {
            background: rgba(255,255,255,0.1);
            transform: translateY(-3px);
        }
        .info-card-icon {
            width: 52px;
            height: 52px;
            background: var(--gradient);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            font-size: 20px;
        }
        .info-card h6 {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 4px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .info-card p {
            font-size: 15px;
            opacity: 0.8;
            margin-bottom: 0;
        }
        .contacto-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            align-items: start;
        }
        .form-card {
            background: var(--white);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        }
        .form-card h4 {
            font-size: 22px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 28px;
        }
        .form-card .form-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }
        .form-card .form-control {
            border: 1px solid var(--gray-200);
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 15px;
            background: var(--gray-50);
            transition: all 0.3s;
        }
        .form-card .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(67,56,202,0.08);
            background: var(--white);
        }
        .btn-enviar {
            background: var(--gradient);
            color: var(--white);
            border: none;
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 15px;
            width: 100%;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            letter-spacing: 0.3px;
        }
        .btn-enviar:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(67,56,202,0.35);
            color: var(--white);
        }
        .mapa-container {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            height: 100%;
            min-height: 480px;
        }
        .mapa-container iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }
        @media (max-width: 991px) {
            .info-cards-row { grid-template-columns: 1fr; max-width: 400px; margin: 0 auto 40px; }
            .contacto-grid { grid-template-columns: 1fr; }
            .mapa-container { min-height: 350px; }
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

        /* ===== TOAST ===== */
        .toast-success {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #10B981;
            color: white;
            padding: 16px 24px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            z-index: 9999;
            display: none;
            box-shadow: 0 8px 25px rgba(16,185,129,0.3);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 991px) {
            .hero { padding: 110px 0 90px; }
            .hero h1 { font-size: 38px; }
            .servicio-row, .servicio-row.reverse {
                flex-direction: column;
                gap: 30px;
            }
        }
        @media (max-width: 767px) {
            .hero h1 { font-size: 30px; }
            .hero::after { height: 40px; }
            .section { padding: 60px 0; }
            .section-title { font-size: 26px; }
            .contacto-section h2 { font-size: 22px; }
        }
        @media (max-width: 480px) {
            .hero { padding: 90px 0 70px; }
            .hero h1 { font-size: 26px; }
            .hero::after { height: 30px; }
            .section-title { font-size: 22px; }
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
                    <li class="nav-item"><a class="nav-link active" href="#inicio">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#proposito">Misión y Visión</a></li>
                    <li class="nav-item"><a class="nav-link" href="#servicios">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#valores">Valores</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>
                    @if($posts->count() > 0)
                    <li class="nav-item"><a class="nav-link" href="{{ route('blog.index') }}">Blog</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- ===== HERO ===== -->
    <section class="hero" id="inicio">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1>Grupo Vanguardia:<br>Soluciones empresariales<br>que marcan la diferencia</h1>
                    <p class="lead mb-3">Líderes en BPO y transformación tecnológica con servicios certificados para el crecimiento de su empresa.</p>
                    <p class="sub-lead mb-4">Contamos con el equipo profesional y la estructura necesaria para impulsar la eficiencia operativa de su negocio.</p>
                    <a href="#contacto" class="btn-hero">
                        Solicitar Asesoría Profesional <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== EL PROPÓSITO ===== -->
    <section class="section proposito-section" id="proposito">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">El Propósito</h2>
            </div>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="proposito-img">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=600&fit=crop" alt="Equipo de trabajo">
                    </div>
                </div>
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <div class="proposito-card">
                        <div class="proposito-card-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h4>Nuestra Misión</h4>
                        <p>Ser el socio estratégico que impulsa el éxito empresarial mediante soluciones personalizadas y talento humano altamente capacitado.</p>
                    </div>
                    <div class="proposito-card mb-0">
                        <div class="proposito-card-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h4>Nuestra Visión</h4>
                        <p>Aspiramos a ser referentes globales en la gestión del conocimiento, guiados por la innovación constante, la excelencia operativa y un firme compromiso con la responsabilidad social.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CASOS DE ÉXITO ===== -->
    <section class="section" id="casos">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Casos de Éxito</h2>
                <p class="section-subtitle">Empresas que confían en nuestras soluciones</p>
            </div>
            <div class="casos-grid">
                <div class="caso-card">
                    <img src="{{ asset('images/casos/1DpZjhTl_400x400.jpg.webp') }}" alt="Grin">
                </div>
                <div class="caso-card">
                    <img src="{{ asset('images/casos/ECONDUCE.jpeg.webp') }}" alt="Econduce">
                </div>
                <div class="caso-card">
                    <img src="{{ asset('images/casos/1DpZjhTl_400x400-1.jpg.webp') }}" alt="Partner">
                </div>
                <div class="caso-card">
                    <img src="{{ asset('images/casos/WALMART-80.jpeg.webp') }}" alt="Walmart">
                </div>
                <div class="caso-card">
                    <img src="{{ asset('images/casos/BIG-COLA-80.jpeg.webp') }}" alt="Big Cola">
                </div>
                <div class="caso-card">
                    <img src="{{ asset('images/casos/logo4.jpeg.webp') }}" alt="Gobierno de México">
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SERVICIOS ===== -->
    <section class="section section-gray" id="servicios">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Servicios Especializados</h2>
                <p class="section-subtitle">Soluciones tecnológicas innovadoras diseñadas para transformar su negocio</p>
            </div>

            @foreach($servicios as $index => $servicio)
            <div class="servicio-row {{ $index % 2 !== 0 ? 'reverse' : '' }}">
                <div class="servicio-img">
                    @if($servicio->imagen)
                        <img src="{{ asset('storage/' . $servicio->imagen) }}" alt="{{ $servicio->nombre }}">
                    @else
                        @php
                            $placeholders = [
                                'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=800&h=500&fit=crop',
                                'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=800&h=500&fit=crop',
                                'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=500&fit=crop',
                            ];
                        @endphp
                        <img src="{{ $placeholders[$index % 3] }}" alt="{{ $servicio->nombre }}">
                    @endif
                </div>
                <div class="servicio-content">
                    <div class="servicio-icon">
                        <i class="{{ $servicio->icono ?? 'fas fa-cogs' }}"></i>
                    </div>
                    <h3>{{ $servicio->nombre }}</h3>
                    <p>{{ $servicio->descripcion }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- ===== VALORES CORPORATIVOS ===== -->
    <section class="section" id="valores">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Valores Corporativos</h2>
                <p class="section-subtitle">Principios que guían nuestra forma de trabajar y relacionarnos</p>
            </div>
            <div class="valores-grid">
                @foreach($valores as $valor)
                <div class="valor-card">
                    <div class="valor-icon">
                        <i class="{{ $valor->icono ?? 'fas fa-star' }}"></i>
                    </div>
                    <h5>{{ $valor->nombre }}</h5>
                    <p>{{ $valor->descripcion }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ===== TESTIMONIOS ===== -->
    @if($testimonios->count() > 0)
    <section class="section section-gray">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Lo que dicen nuestros clientes</h2>
                <p class="section-subtitle">Testimonios de empresas que confían en nosotros</p>
            </div>
            <div class="row g-4">
                @foreach($testimonios as $testimonio)
                <div class="col-lg-4 col-md-6">
                    <div class="testimonio-card">
                        <div class="quote-icon">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="testimonio-stars">
                            @for($i = 0; $i < $testimonio->estrellas; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>
                        <p class="testimonio-text">
                            "{{ $testimonio->texto }}"
                        </p>
                        <div class="testimonio-author">
                            <div class="testimonio-avatar">
                                {{ strtoupper(substr($testimonio->nombre, 0, 1)) }}
                            </div>
                            <div class="testimonio-author-info">
                                <strong>{{ $testimonio->nombre }}</strong>
                                @if($testimonio->cargo || $testimonio->empresa)
                                <span>{{ $testimonio->cargo }}{{ $testimonio->empresa ? ' — ' . $testimonio->empresa : '' }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- ===== CONTACTO ===== -->
    <section class="contacto-section" id="contacto">
        <div class="container">
            <div class="contacto-header">
                <h2>Conversemos sobre su próximo proyecto</h2>
                <p>Estamos listos para ayudarle a transformar su negocio con soluciones tecnológicas de vanguardia</p>
            </div>
            <div class="contacto-body">
                <div class="info-cards-row">
                    <div class="info-card">
                        <div class="info-card-icon"><i class="fas fa-phone-alt"></i></div>
                        <h6>Teléfono</h6>
                        <p>55 8526 3542</p>
                    </div>
                    <div class="info-card">
                        <div class="info-card-icon"><i class="fas fa-envelope"></i></div>
                        <h6>Correo</h6>
                        <p>soporte@cgpvc.com</p>
                    </div>
                    <div class="info-card">
                        <div class="info-card-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <h6>Ubicación</h6>
                        <p>Calzada de Tlalpan 609, CDMX</p>
                    </div>
                </div>
                <div class="contacto-grid">
                    <div class="form-card">
                        <h4><i class="fas fa-paper-plane me-2" style="color: var(--primary);"></i>Envíanos un mensaje</h4>
                        <form id="contactForm">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nombre *</label>
                                    <input type="text" class="form-control" name="nombre" placeholder="Tu nombre" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Correo *</label>
                                    <input type="email" class="form-control" name="email" placeholder="tu@email.com" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Teléfono</label>
                                    <input type="tel" class="form-control" name="telefono" placeholder="55 1234 5678">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Empresa</label>
                                    <input type="text" class="form-control" name="empresa" placeholder="Nombre de tu empresa">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Mensaje *</label>
                                    <textarea class="form-control" name="mensaje" rows="4" placeholder="¿Cómo podemos ayudarte?" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn-enviar" id="btnEnviar">
                                        Enviar mensaje <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="mapa-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3763.5!2d-99.1439!3d19.3537!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1ff35f5bd1563%3A0x6c366f0e2de02ff7!2sCalzada%20de%20Tlalpan%20609%2C%20CDMX!5e0!3m2!1ses!2smx" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
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
                        <li><a href="#inicio">Inicio</a></li>
                        <li><a href="#proposito">Misión y Visión</a></li>
                        <li><a href="#servicios">Servicios</a></li>
                        <li><a href="#valores">Valores</a></li>
                        <li><a href="#contacto">Contacto</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h6>Servicios</h6>
                    <ul>
                        <li><a href="#servicios">Inteligencia Artificial</a></li>
                        <li><a href="#servicios">Ciberseguridad</a></li>
                        <li><a href="#servicios">BPO</a></li>
                        <li><a href="#servicios">Consultoría</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h6>Contacto</h6>
                    <ul>
                        <li><a href="tel:5585263542"><i class="fas fa-phone-alt"></i>55 8526 3542</a></li>
                        <li><a href="mailto:soporte@cgpvc.com"><i class="fas fa-envelope"></i>soporte@cgpvc.com</a></li>
                        <li><a href="#contacto"><i class="fas fa-map-marker-alt"></i>CDMX, México</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Grupo Vanguardia. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Toast de éxito -->
    <div class="toast-success" id="toastSuccess">
        <i class="fas fa-check-circle me-2"></i>
        <span id="toastMessage">Mensaje enviado correctamente</span>
    </div>

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('mainNav');
            nav.classList.toggle('scrolled', window.scrollY > 50);
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                e.preventDefault();
                const target = document.querySelector(a.getAttribute('href'));
                if (target) {
                    const offset = 80;
                    window.scrollTo({ top: target.offsetTop - offset, behavior: 'smooth' });
                }
                // Close mobile menu
                const navCollapse = document.querySelector('.navbar-collapse');
                if (navCollapse.classList.contains('show')) {
                    bootstrap.Collapse.getInstance(navCollapse)?.hide();
                }
            });
        });

        // Contact form AJAX
        document.getElementById('contactForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const btn = document.getElementById('btnEnviar');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';
            btn.disabled = true;

            try {
                const formData = new FormData(this);
                const response = await fetch('{{ route("contacto.store") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: formData
                });
                const data = await response.json();

                if (data.success) {
                    this.reset();
                    showToast(data.message);
                } else {
                    const errors = data.errors ? Object.values(data.errors).flat().join('\n') : 'Error al enviar';
                    alert(errors);
                }
            } catch (err) {
                alert('Error de conexión. Intenta de nuevo.');
            }

            btn.innerHTML = originalText;
            btn.disabled = false;
        });

        function showToast(message) {
            const toast = document.getElementById('toastSuccess');
            document.getElementById('toastMessage').textContent = message;
            toast.style.display = 'block';
            setTimeout(() => { toast.style.display = 'none'; }, 4000);
        }
    </script>
</body>
</html>
