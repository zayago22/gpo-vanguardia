<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('seo.pages.call-center.title', 'Call Center Omnicanal | Grupo Vanguardia') }}</title>
    <meta name="description" content="{{ config('seo.pages.call-center.meta_description') }}">
    <meta name="keywords" content="{{ config('seo.pages.call-center.meta_keywords') }}">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    @include('partials.seo-head', ['seoPage' => 'call-center'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --primary:#4338CA;--primary-light:#6366F1;--primary-dark:#3730A3;--secondary:#818CF8;--dark:#1E1B4B;--gray-50:#F8FAFC;--gray-200:#E2E8F0;--gray-500:#64748B;--gray-600:#475569;--gray-700:#334155;--white:#FFFFFF;--gradient:linear-gradient(135deg,var(--primary) 0%,var(--primary-light) 50%,var(--secondary) 100%); }
        *{box-sizing:border-box}body{font-family:'Montserrat',sans-serif;color:var(--gray-700);overflow-x:hidden}
        .navbar-custom{background:var(--white);padding:12px 0;border-bottom:3px solid var(--primary)}.navbar-custom.scrolled{box-shadow:0 2px 20px rgba(0,0,0,.08)}.navbar-custom .navbar-brand img{height:40px}.navbar-custom .nav-link{color:var(--gray-700)!important;font-weight:500;font-size:14px;padding:8px 16px!important;transition:color .3s}.navbar-custom .nav-link:hover,.navbar-custom .nav-link.active{color:var(--primary)!important}.navbar-custom .dropdown-menu{border:none;border-radius:12px;box-shadow:0 10px 40px rgba(0,0,0,.12);padding:8px 0}.navbar-custom .dropdown-item{font-size:14px;font-weight:500;color:var(--gray-700);padding:10px 20px;transition:all .2s}.navbar-custom .dropdown-item:hover{background:rgba(67,56,202,.06);color:var(--primary)}.navbar-custom .dropdown-item i{width:22px;color:var(--primary-light);margin-right:6px}
        .page-hero{background:linear-gradient(135deg,var(--primary-dark) 0%,var(--primary) 50%,var(--primary-light) 100%);padding:100px 0 80px;color:#fff;position:relative;overflow:hidden}.page-hero::after{content:'';position:absolute;bottom:-1px;left:0;right:0;height:60px;background:var(--gray-50);clip-path:ellipse(55% 100% at 50% 100%)}.page-hero h1{font-size:48px;font-weight:800;margin-bottom:16px;letter-spacing:-.5px}.page-hero p{font-size:18px;opacity:.85;max-width:680px}
        .section{padding:90px 0}
        .content-card{background:#fff;border-radius:20px;padding:48px;box-shadow:0 8px 30px rgba(0,0,0,.07);font-size:16px;line-height:1.9;color:var(--gray-600)}
        .content-card p{margin-bottom:20px}.content-card p:last-child{margin-bottom:0}
        .related-nav{display:flex;gap:16px;flex-wrap:wrap;margin-top:40px}
        .related-btn{display:inline-flex;align-items:center;gap:10px;padding:14px 24px;border-radius:12px;font-weight:600;font-size:14px;text-decoration:none;transition:all .3s}
        .related-btn.active{background:var(--primary);color:#fff;box-shadow:0 6px 20px rgba(67,56,202,.3)}
        .related-btn.inactive{background:#fff;color:var(--primary);border:2px solid var(--gray-200)}
        .related-btn.inactive:hover{border-color:var(--primary);background:rgba(67,56,202,.04)}
        .footer{background:var(--dark);padding:60px 0 30px}.footer-top{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:40px;margin-bottom:40px;padding-bottom:40px;border-bottom:1px solid rgba(255,255,255,.08)}.footer-about{color:rgba(255,255,255,.6);font-size:14px;line-height:1.7}.footer-brand{display:flex;align-items:center;gap:10px;margin-bottom:16px}.footer-brand img{height:36px}.footer-brand span{color:#fff;font-size:17px;font-weight:700}.footer-socials{display:flex;gap:10px;margin-top:16px}.footer-socials a{width:38px;height:38px;border-radius:10px;background:rgba(255,255,255,.07);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.6);font-size:16px;transition:all .3s;text-decoration:none}.footer-socials a:hover{background:var(--primary);color:#fff}.footer-col h6{color:#fff;font-size:14px;font-weight:700;text-transform:uppercase;letter-spacing:1px;margin-bottom:20px}.footer-col ul{list-style:none;padding:0;margin:0}.footer-col ul li{margin-bottom:10px}.footer-col ul li a{color:rgba(255,255,255,.55);text-decoration:none;font-size:14px;transition:color .3s}.footer-col ul li a:hover{color:#fff}.footer-col ul li i{width:20px;color:var(--primary-light);margin-right:6px;font-size:13px}.footer-bottom{text-align:center}.footer-bottom p{color:rgba(255,255,255,.4);font-size:13px;margin-bottom:0}
        @media(max-width:991px){.footer-top{grid-template-columns:1fr 1fr}.page-hero h1{font-size:34px}}@media(max-width:575px){.footer-top{grid-template-columns:1fr;gap:30px}}
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt="GPO Vanguardia"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="border-color:var(--gray-200)"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" data-bs-toggle="dropdown">Servicios</a>
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('blog.index') }}">Blog</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div style="padding-top:79px">
        <section class="page-hero">
            <div class="container">
                <h1>Call Center Omnicanal</h1>
                <p>El servicio al cliente es una prioridad. Conectamos todos los canales de comunicación digital para ofrecer una experiencia unificada a sus clientes.</p>
            </div>
        </section>
    </div>

    <section class="section" style="background:var(--gray-50)">
        <div class="container">
            <div class="content-card">
                <p>El servicio al cliente es una prioridad para muchas empresas por una buena razón, una abrumadora mayoría de las personas, 96% acorde al reporte de Microsoft: State of global service, informa que el servicio al cliente es un factor importante al determinar si son leales a las marcas. De hecho, siguiendo con dicho reporte, las compañías perdieron $ 75 mil millones en deserción de clientes debido a malas experiencias de servicio al cliente solo en 2017.</p>
                <p>Las marcas e instituciones tienen el desafío de cumplir con las expectativas de servicio al cliente a medida que los nuevos canales de comunicaciones digitales entran en juego. Por muchas razones: estilos de vida ocupados, poseer diversos dispositivos y más, los compradores desean múltiples puntos de contacto con las marcas, y recompensan a las organizaciones que lo ofrecen a través de varios canales.</p>
                <p>Sin embargo, existe una gran diferencia entre multicanal y omnicanal, y los clientes lo han notado. Multicanal significa tener diferentes canales de comunicación a través de los cuales los compradores pueden contactar a su empresa, que es lo que muchos programas de servicio al cliente son capaces de hacer actualmente. Pero omnicanal significa que hay una estrategia detrás de cada punto de contacto digital y todos están conectados para una experiencia más holística, una realidad que muchas organizaciones todavía persiguen.</p>
                <p>Afortunadamente, los Call Center omnicanal basados en la nube permiten a las empresas agregar nuevos canales de comunicación a su programa digital de servicio al cliente cuando estén listos e integrar fácilmente nuevos canales con los ya existentes. Conectar canales de comunicación dispares como el correo electrónico, el texto y las redes sociales inspira una experiencia unificada de servicio al cliente que aumenta métricas como la satisfacción y la lealtad a la marca.</p>
            </div>

            <div class="related-nav">
                <a href="{{ route('call-center') }}" class="related-btn active"><i class="fas fa-headset"></i>Call Center Omnicanal</a>
                <a href="{{ route('chatbots') }}" class="related-btn inactive"><i class="fas fa-robot"></i>Chat Bots y AI</a>
                <a href="{{ route('mesa-servicios') }}" class="related-btn inactive"><i class="fas fa-tools"></i>Mesa de Servicios</a>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-top">
                <div class="footer-about">
                    <div class="footer-brand"><img src="{{ asset('images/logo.png') }}" alt="GPO Vanguardia"><span>Grupo Vanguardia</span></div>
                    <p>Soluciones empresariales que marcan la diferencia. Líderes en BPO, IA, ciberseguridad y transformación tecnológica.</p>
                    <div class="footer-socials">
                        <a href="https://www.facebook.com/callcentergrupovanguardia" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.linkedin.com/company/gpo-vanguardia/" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://instagram.com/" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
                        <a href="https://twitter.com/" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="footer-col"><h6>Navegación</h6><ul><li><a href="{{ route('home') }}">Inicio</a></li><li><a href="{{ route('servicios') }}">Servicios</a></li><li><a href="{{ route('clientes') }}">Clientes</a></li><li><a href="{{ route('blog.index') }}">Blog</a></li></ul></div>
                <div class="footer-col"><h6>Servicios</h6><ul><li><a href="{{ route('call-center') }}">Call Center Omnicanal</a></li><li><a href="{{ route('chatbots') }}">Chat Bots y AI</a></li><li><a href="{{ route('mesa-servicios') }}">Mesa de Servicios</a></li><li><a href="{{ route('cctv') }}">CCTV</a></li></ul></div>
                <div class="footer-col"><h6>Contacto</h6><ul><li><a href="tel:5585263542"><i class="fas fa-phone-alt"></i>55 8526 3542</a></li><li><a href="mailto:soporte@cgpvc.com"><i class="fas fa-envelope"></i>soporte@cgpvc.com</a></li><li><a href="{{ route('contacto') }}"><i class="fas fa-map-marker-alt"></i>CDMX, México</a></li><li><a href="{{ route('aviso') }}" style="color:var(--primary-light)">Aviso de privacidad</a></li></ul></div>
            </div>
            <div class="footer-bottom"><p>&copy; {{ date('Y') }} Grupo Vanguardia. Todos los derechos reservados. &middot; <a href="{{ route('terminos') }}" style="color:rgba(255,255,255,.55);text-decoration:none">Términos y Condiciones</a></p></div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>window.addEventListener('scroll',()=>{document.getElementById('mainNav').classList.toggle('scrolled',window.scrollY>50)});</script>
</body>
</html>
