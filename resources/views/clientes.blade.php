<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('seo.pages.clientes.title', 'Clientes | Grupo Vanguardia') }}</title>
    <meta name="description" content="{{ config('seo.pages.clientes.meta_description') }}">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    @include('partials.seo-head', ['seoPage' => 'clientes'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4338CA; --primary-light: #6366F1; --primary-dark: #3730A3;
            --secondary: #818CF8; --dark: #1E1B4B; --gray-50: #F8FAFC;
            --gray-100: #F1F5F9; --gray-200: #E2E8F0; --gray-500: #64748B;
            --gray-600: #475569; --gray-700: #334155; --white: #FFFFFF;
            --gradient: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 50%, var(--secondary) 100%);
        }
        * { box-sizing: border-box; }
        body { font-family: 'Montserrat', sans-serif; color: var(--gray-700); overflow-x: hidden; }

        .navbar-custom { background: var(--white); padding: 12px 0; border-bottom: 3px solid var(--primary); }
        .navbar-custom.scrolled { box-shadow: 0 2px 20px rgba(0,0,0,0.08); }
        .navbar-custom .navbar-brand img { height: 40px; }
        .navbar-custom .nav-link { color: var(--gray-700) !important; font-weight: 500; font-size: 14px; padding: 8px 16px !important; transition: color 0.3s; }
        .navbar-custom .nav-link:hover, .navbar-custom .nav-link.active { color: var(--primary) !important; }
        .navbar-custom .dropdown-menu { border: none; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.12); padding: 8px 0; }
        .navbar-custom .dropdown-item { font-size: 14px; font-weight: 500; color: var(--gray-700); padding: 10px 20px; transition: all 0.2s; }
        .navbar-custom .dropdown-item:hover { background: rgba(67,56,202,0.06); color: var(--primary); }
        .navbar-custom .dropdown-item i { width: 22px; color: var(--primary-light); margin-right: 6px; }

        .page-hero {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 50%, var(--primary-light) 100%);
            padding: 100px 0 80px; color: white; position: relative; overflow: hidden;
        }
        .page-hero::after { content: ''; position: absolute; bottom: -1px; left: 0; right: 0; height: 60px; background: var(--gray-50); clip-path: ellipse(55% 100% at 50% 100%); }
        .page-hero h1 { font-size: 48px; font-weight: 800; margin-bottom: 16px; letter-spacing: -0.5px; }
        .page-hero p { font-size: 18px; opacity: 0.85; max-width: 600px; }

        .section { padding: 90px 0; }
        .section-title { font-size: 38px; font-weight: 800; color: var(--dark); letter-spacing: -0.5px; margin-bottom: 12px; }
        .section-title::after { content: ''; display: block; width: 60px; height: 3px; background: var(--primary); margin: 12px auto 0; border-radius: 2px; }

        .caso-card {
            background: var(--white); border-radius: 20px; padding: 40px 32px;
            box-shadow: 0 6px 24px rgba(0,0,0,0.06); margin-bottom: 32px;
            border-left: 4px solid var(--primary); transition: all 0.3s;
        }
        .caso-card:hover { transform: translateY(-4px); box-shadow: 0 12px 35px rgba(67,56,202,0.12); }
        .caso-card h3 { font-size: 22px; font-weight: 700; color: var(--dark); margin-bottom: 14px; }
        .caso-card p { font-size: 15px; color: var(--gray-600); line-height: 1.8; margin-bottom: 20px; }
        .caso-badge { display: inline-block; background: rgba(67,56,202,0.08); color: var(--primary); padding: 4px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; margin-bottom: 16px; }
        .btn-primary-custom { display: inline-flex; align-items: center; gap: 8px; background: var(--primary); color: white; padding: 12px 24px; border-radius: 10px; font-weight: 600; font-size: 14px; text-decoration: none; transition: all 0.3s; }
        .btn-primary-custom:hover { background: var(--primary-dark); color: white; transform: translateY(-2px); }

        .footer { background: var(--dark); padding: 60px 0 30px; }
        .footer-top { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 40px; margin-bottom: 40px; padding-bottom: 40px; border-bottom: 1px solid rgba(255,255,255,0.08); }
        .footer-about { color: rgba(255,255,255,0.6); font-size: 14px; line-height: 1.7; }
        .footer-brand { display: flex; align-items: center; gap: 10px; margin-bottom: 16px; }
        .footer-brand img { height: 36px; }
        .footer-brand span { color: var(--white); font-size: 17px; font-weight: 700; }
        .footer-socials { display: flex; gap: 10px; margin-top: 16px; }
        .footer-socials a { width: 38px; height: 38px; border-radius: 10px; background: rgba(255,255,255,0.07); display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.6); font-size: 16px; transition: all 0.3s; text-decoration: none; }
        .footer-socials a:hover { background: var(--primary); color: var(--white); }
        .footer-col h6 { color: var(--white); font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; }
        .footer-col ul { list-style: none; padding: 0; margin: 0; }
        .footer-col ul li { margin-bottom: 10px; }
        .footer-col ul li a { color: rgba(255,255,255,0.55); text-decoration: none; font-size: 14px; transition: color 0.3s; }
        .footer-col ul li a:hover { color: var(--white); }
        .footer-col ul li i { width: 20px; color: var(--primary-light); margin-right: 6px; font-size: 13px; }
        .footer-bottom { text-align: center; }
        .footer-bottom p { color: rgba(255,255,255,0.4); font-size: 13px; margin-bottom: 0; }
        @media (max-width: 991px) { .footer-top { grid-template-columns: 1fr 1fr; } .page-hero h1 { font-size: 34px; } }
        @media (max-width: 575px) { .footer-top { grid-template-columns: 1fr; gap: 30px; } }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt="GPO Vanguardia"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="border-color: var(--gray-200);"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Servicios</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('servicios') }}"><i class="fas fa-cogs"></i>Todos los Servicios</a></li>
                            <li><a class="dropdown-item" href="{{ route('call-center') }}"><i class="fas fa-headset"></i>Call Center Omnicanal</a></li>
                            <li><a class="dropdown-item" href="{{ route('chatbots') }}"><i class="fas fa-robot"></i>Chat Bots y AI</a></li>
                            <li><a class="dropdown-item" href="{{ route('mesa-servicios') }}"><i class="fas fa-tools"></i>Mesa de Servicios</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('cctv') }}"><i class="fas fa-video"></i>CCTV</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('clientes') }}">Clientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contacto') }}">Contacto</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('blog.index') }}">Blog</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div style="padding-top: 79px;">
        <section class="page-hero">
            <div class="container">
                <h1>Casos de Éxito</h1>
                <p>Conoce cómo hemos ayudado a nuestros clientes a crecer con soluciones tecnológicas de vanguardia.</p>
                <a href="{{ route('contacto') }}" class="btn-primary-custom mt-3" style="background: white; color: var(--primary);">
                    Cuéntanos tu idea <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </section>
    </div>

    <section class="section" style="background: var(--gray-50);">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Nuestros Clientes</h2>
            </div>

            <div class="caso-card">
                <span class="caso-badge">Movilidad Urbana</span>
                <h3>VBIKE</h3>
                <p>Con la introducción de 50 mil bicicletas verdes que no necesitan de estaciones y llegando a más de 35 mil usuarios, la startup mexicana VBike tenía que ofrecer un servicio de atención al cliente eficiente y de la mejor calidad, para responder al flujo de llamadas de sus usuarios en constante crecimiento.</p>
                <p>Nosotros aportamos la solución exitosa con nuestros servicios de BPI y Call Center, desarrollando los procesos para brindar una gran experiencia de servicio a los clientes de la startup innovadora.</p>
                <a href="{{ route('contacto') }}" class="btn-primary-custom">Solicitar asesoría <i class="fas fa-arrow-right"></i></a>
            </div>

            <div class="caso-card">
                <span class="caso-badge">Movilidad Sustentable</span>
                <h3>ECONDUCE</h3>
                <p>Con una propuesta diferente en el rubro de la movilidad urbana, Econduce llegó al mercado de la movilidad sustentable con sus cómodos scooters eléctricos que no producen emisiones y no hacen ruido.</p>
                <p>Con más de un millón de viajes hasta la fecha, nos hicimos cargo de dar respuesta y una excelente atención telefónica a todos esos usuarios moviéndose en el corazón de la ciudad.</p>
                <a href="{{ route('contacto') }}" class="btn-primary-custom">Solicitar asesoría <i class="fas fa-arrow-right"></i></a>
            </div>

            <div class="caso-card">
                <span class="caso-badge">Micro-movilidad</span>
                <h3>GRIN</h3>
                <p>Grin, una de las principales comunidades de movilidad diferente dentro de las zonas urbanas, conecta con las personas de una forma sencilla, amena y ecológica con sus icónicos monopatines eléctricos.</p>
                <p>Ante su crecimiento y expansión, Grin tenía el reto de responder a la demanda de llamadas de sus usuarios vía telefónica, y ahí brindamos nuestras soluciones de Call Center y BPI, dando calidad, productividad y tiempo de respuesta a todos sus clientes.</p>
                <a href="{{ route('contacto') }}" class="btn-primary-custom">Solicitar asesoría <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </section>

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
        window.addEventListener('scroll', () => { document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 50); });
    </script>
</body>
</html>
