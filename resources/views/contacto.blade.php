<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('seo.pages.contacto.title', 'Contacto | Grupo Vanguardia') }}</title>
    <meta name="description" content="{{ config('seo.pages.contacto.meta_description') }}">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    @include('partials.seo-head', ['seoPage' => 'contacto'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4338CA; --primary-light: #6366F1; --primary-dark: #3730A3;
            --secondary: #818CF8; --dark: #1E1B4B; --gray-50: #F8FAFC;
            --gray-200: #E2E8F0; --gray-500: #64748B; --gray-600: #475569;
            --gray-700: #334155; --white: #FFFFFF;
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

        .page-hero { background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 50%, var(--primary-light) 100%); padding: 100px 0 80px; color: white; position: relative; overflow: hidden; }
        .page-hero::after { content: ''; position: absolute; bottom: -1px; left: 0; right: 0; height: 60px; background: var(--gray-50); clip-path: ellipse(55% 100% at 50% 100%); }
        .page-hero h1 { font-size: 48px; font-weight: 800; margin-bottom: 16px; letter-spacing: -0.5px; }
        .page-hero p { font-size: 18px; opacity: 0.85; }

        .section { padding: 90px 0; }

        .info-card { background: var(--white); border-radius: 20px; padding: 36px 28px; text-align: center; box-shadow: 0 6px 24px rgba(0,0,0,0.06); }
        .info-card-icon { width: 60px; height: 60px; border-radius: 16px; background: var(--gradient); display: flex; align-items: center; justify-content: center; color: white; font-size: 22px; margin: 0 auto 16px; }
        .info-card h6 { font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: var(--gray-500); margin-bottom: 8px; }
        .info-card p { font-size: 16px; font-weight: 600; color: var(--dark); margin: 0; }

        .form-card { background: var(--white); border-radius: 20px; padding: 44px; box-shadow: 0 8px 30px rgba(0,0,0,0.07); }
        .form-card h4 { font-size: 22px; font-weight: 700; color: var(--dark); margin-bottom: 28px; }
        .form-control { border-radius: 10px; border: 1.5px solid var(--gray-200); padding: 13px 16px; font-size: 14px; font-family: 'Montserrat', sans-serif; transition: border-color 0.3s; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(67,56,202,0.08); }
        .form-label { font-size: 13px; font-weight: 600; color: var(--gray-700); margin-bottom: 6px; }
        .btn-enviar { background: var(--gradient); color: white; border: none; padding: 16px 40px; border-radius: 12px; font-weight: 700; font-size: 15px; font-family: 'Montserrat', sans-serif; cursor: pointer; transition: all 0.3s; width: 100%; }
        .btn-enviar:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(67,56,202,0.35); }

        .mapa-container { border-radius: 20px; overflow: hidden; box-shadow: 0 8px 30px rgba(0,0,0,0.07); height: 100%; min-height: 380px; }
        .mapa-container iframe { width: 100%; height: 100%; min-height: 380px; border: none; display: block; }

        .redes-sociales { display: flex; gap: 14px; margin-top: 16px; }
        .red-social-btn { display: flex; align-items: center; gap: 8px; padding: 10px 18px; border-radius: 10px; text-decoration: none; font-size: 14px; font-weight: 600; transition: all 0.3s; }
        .red-social-btn.facebook { background: #1877F2; color: white; }
        .red-social-btn.linkedin { background: #0A66C2; color: white; }
        .red-social-btn:hover { transform: translateY(-2px); opacity: 0.9; }

        .toast-success { position: fixed; top: 20px; right: 20px; background: #10B981; color: white; padding: 16px 24px; border-radius: 12px; font-size: 14px; font-weight: 500; z-index: 9999; display: none; box-shadow: 0 8px 25px rgba(16,185,129,0.3); }

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
                    <li class="nav-item"><a class="nav-link" href="{{ route('clientes') }}">Clientes</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('contacto') }}">Contacto</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('blog.index') }}">Blog</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div style="padding-top: 79px;">
        <section class="page-hero">
            <div class="container">
                <h1>Contáctanos</h1>
                <p>Datos de contacto: Teléfono: 55 8526 3542 &nbsp;|&nbsp; Email: soporte@ccgvic.com &nbsp;|&nbsp; Dirección: Calz. De Tlalpan 609. CDMX</p>
            </div>
        </section>
    </div>

    <section class="section" style="background: var(--gray-50);">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="info-card">
                        <div class="info-card-icon"><i class="fas fa-phone-alt"></i></div>
                        <h6>Teléfono</h6>
                        <p><a href="tel:5585263542" style="color: var(--dark); text-decoration: none;">55 8526 3542</a></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card">
                        <div class="info-card-icon"><i class="fas fa-envelope"></i></div>
                        <h6>Correo</h6>
                        <p><a href="mailto:soporte@ccgvic.com" style="color: var(--dark); text-decoration: none;">soporte@ccgvic.com</a></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card">
                        <div class="info-card-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <h6>Dirección</h6>
                        <p>Calz. De Tlalpan 609, CDMX</p>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-12 text-center">
                    <h5 style="font-weight: 700; color: var(--dark); margin-bottom: 16px;">Síguenos en redes sociales</h5>
                    <div class="redes-sociales justify-content-center">
                        <a href="https://www.facebook.com/callcentergrupovanguardia" target="_blank" class="red-social-btn facebook">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </a>
                        <a href="https://www.linkedin.com/company/gpo-vanguardia/" target="_blank" class="red-social-btn linkedin">
                            <i class="fab fa-linkedin-in"></i> LinkedIn
                        </a>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-6">
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
                                    <label class="form-label">Asunto *</label>
                                    <input type="text" class="form-control" name="asunto" placeholder="¿En qué podemos ayudarte?" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Mensaje *</label>
                                    <textarea class="form-control" name="mensaje" rows="4" placeholder="Describe tu proyecto o consulta" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn-enviar" id="btnEnviar">
                                        Enviar mensaje <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mapa-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3763.5!2d-99.1439!3d19.3537!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1ff35f5bd1563%3A0x6c366f0e2de02ff7!2sCalzada%20de%20Tlalpan%20609%2C%20CDMX!5e0!3m2!1ses!2smx" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
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

    <div class="toast-success" id="toastSuccess">
        <i class="fas fa-check-circle me-2"></i>
        <span id="toastMessage">Mensaje enviado correctamente</span>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('scroll', () => { document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 50); });

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
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
                    body: formData
                });
                const data = await response.json();
                if (data.success) {
                    this.reset();
                    const toast = document.getElementById('toastSuccess');
                    document.getElementById('toastMessage').textContent = data.message;
                    toast.style.display = 'block';
                    setTimeout(() => { toast.style.display = 'none'; }, 4000);
                } else {
                    const errors = data.errors ? Object.values(data.errors).flat().join('\n') : 'Error al enviar';
                    alert(errors);
                }
            } catch(err) { alert('Error de conexión. Intenta de nuevo.'); }
            btn.innerHTML = originalText;
            btn.disabled = false;
        });
    </script>
</body>
</html>
