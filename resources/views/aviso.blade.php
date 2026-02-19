<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ config('seo.pages.aviso.meta_description', 'Aviso de Privacidad de Grupo Vanguardia') }}">
    <title>{{ config('seo.pages.aviso.title', 'Aviso de Privacidad — GPO Vanguardia') }}</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    @include('partials.seo-head', ['seoPage' => 'aviso'])

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
            font-size: 19px;
            font-weight: 700;
            color: var(--dark);
            margin-top: 40px;
            margin-bottom: 14px;
            display: flex;
            align-items: flex-start;
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
            font-size: 15px;
            font-weight: 700;
            color: var(--primary);
            flex-shrink: 0;
            margin-top: 1px;
        }
        .legal-card h3 {
            font-size: 15px;
            font-weight: 700;
            color: var(--primary);
            margin-top: 22px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .legal-card h2:first-child { margin-top: 0; }
        .legal-card p {
            font-size: 14.5px;
            color: var(--gray-600);
            line-height: 1.85;
            margin-bottom: 12px;
        }
        .legal-card ul, .legal-card ol {
            font-size: 14.5px;
            color: var(--gray-600);
            line-height: 1.85;
            padding-left: 24px;
            margin-bottom: 14px;
        }
        .legal-card li { margin-bottom: 8px; }
        .legal-card a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }
        .legal-card a:hover { text-decoration: underline; }
        .legal-intro {
            font-size: 15px !important;
            color: var(--gray-700) !important;
            border-left: 4px solid var(--primary);
            padding-left: 20px;
            margin-bottom: 32px !important;
        }
        .legal-note {
            background: rgba(67,56,202,0.04);
            border-radius: 10px;
            padding: 16px 20px;
            font-size: 14px !important;
            color: var(--gray-600) !important;
            border-left: 4px solid var(--primary-light);
            margin-top: 8px;
            margin-bottom: 14px;
        }
        .download-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--gradient);
            color: var(--white) !important;
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none !important;
            margin-top: 10px;
            transition: opacity 0.2s;
        }
        .download-btn:hover { opacity: 0.88; }

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
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#proposito">Misión y Visión</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Servicios</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('servicios') }}"><i class="fas fa-th-large"></i>Todos los Servicios</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('call-center') }}"><i class="fas fa-headset"></i>Call Center Omnicanal</a></li>
                            <li><a class="dropdown-item" href="{{ route('chatbots') }}"><i class="fas fa-robot"></i>Chat Bots y AI</a></li>
                            <li><a class="dropdown-item" href="{{ route('mesa-servicios') }}"><i class="fas fa-tools"></i>Mesa de Servicios</a></li>
                            <li><a class="dropdown-item" href="{{ route('cctv') }}"><i class="fas fa-video"></i>CCTV</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('clientes') }}">Clientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contacto') }}">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ===== PAGE HEADER ===== -->
    <section class="page-header">
        <div class="container">
            <h1>Aviso de Privacidad Integral</h1>
            <p>Actualización: 30 de mayo de 2025</p>
        </div>
    </section>

    <!-- ===== CONTENT ===== -->
    <section class="legal-content">
        <div class="container">
            <div class="legal-card">
                <p class="legal-intro">
                    <strong>GRUPO VANGUARDIA EN INFORMACIÓN Y CONOCIMIENTO, S.A. DE C.V.</strong>, en lo sucesivo GRUPO VANGUARDIA, persona moral constituida conforme a las leyes mexicanas, con domicilio para oír y recibir notificaciones ubicado en Calz. de Tlalpan no. 609, Col. Álamos, C.P. 03400, Alcaldía Benito Juárez, CDMX, es consciente de la importancia que tienen el tratamiento legítimo, controlado e informado de sus datos personales, por lo que GRUPO VANGUARDIA pone a su disposición el presente Aviso de Privacidad, a fin de que conozca sus prácticas al obtener, usar, divulgar o almacenar sus datos personales, de conformidad con la <strong>Ley Federal de Protección de Datos Personales en Posesión de los Particulares</strong>.
                </p>

                <!-- 1 -->
                <h2><span class="num">1</span> Finalidad del Tratamiento de Datos</h2>
                <p>Los datos personales que recabamos de usted, los utilizaremos para las siguientes finalidades que son necesarias para los servicios que solicita o le serán proporcionados:</p>

                <h3>Finalidades principales</h3>
                <ul>
                    <li><strong>Provisión de Servicios de Contact Center y Tecnología:</strong> Para la operación, gestión, análisis y mejora continua de nuestros servicios de Contact Center Omnicanal, Chat Bots e Inteligencia Artificial, Mesa de Servicios (Service Desk), soluciones de videovigilancia (CCTV) y plataformas de marketing digital, incluyendo la personalización de la interacción, el seguimiento de consultas, la resolución de incidentes y la gestión de la calidad de servicio.</li>
                    <li><strong>Gestión y Mejora de la Relación con Clientes y Usuarios:</strong> Para atender sus solicitudes, consultas, dudas, quejas o sugerencias relacionadas con nuestros servicios; realizar encuestas de satisfacción para evaluar la calidad de nuestros servicios y la experiencia del usuario; y para mantener comunicación relevante con usted sobre la prestación y mejora de los servicios contratados.</li>
                    <li><strong>Actividades de Marketing y Prospección Comercial:</strong> Para el envío de información sobre nuestros productos, servicios, promociones, eventos, novedades y ofertas que puedan ser de su interés, tanto propios como de socios comerciales, si usted ha otorgado su consentimiento para ello o si existe una relación comercial preexistente. Esto incluye actividades de prospección comercial, publicidad segmentada y análisis de mercado para el desarrollo de nuevos servicios y la optimización de nuestras estrategias de negocio.</li>
                    <li><strong>Análisis Internos y Estadísticos:</strong> Para realizar análisis internos, estudios estadísticos y elaboración de perfiles de uso que nos permitan entender las tendencias, optimizar la operación de nuestros servicios, evaluar el rendimiento y tomar decisiones estratégicas de negocio, siempre de forma anonimizada o agregada, cuando sea posible.</li>
                    <li><strong>Cumplimiento de Obligaciones Legales y Contractuales:</strong> Para cumplir con las obligaciones legales aplicables, así como para el cumplimiento de contratos y acuerdos con usted, incluyendo la facturación y cobranza de nuestros servicios.</li>
                    <li><strong>Seguridad de la Información y de las Operaciones:</strong> Para garantizar la seguridad, integridad y confidencialidad de la información y de nuestras operaciones, incluyendo la prevención de fraudes, la detección de incidentes de seguridad y la protección contra actividades ilícitas o maliciosas.</li>
                    <li><strong>Reclutamiento, selección y contratación de personal:</strong> Para llevar a cabo el proceso de reclutamiento, selección y contratación del personal. La información formará parte de la bolsa de trabajo de la empresa. La información se podrá transferir a un tercero, outsourcing o Institución Financiera para que lleve a cabo el pago de la contraprestación de los servicios. Para generar perfiles y estructuras laborales, realizar informes estadísticos y evaluar el desempeño. Solicitar referencias personales y laborales del solicitante. Para integrar el expediente del colaborador, administrar la contraprestación de los servicios y cumplir las obligaciones contractuales. Mantener comunicación con el solicitante durante el proceso de reclutamiento.</li>
                </ul>

                <h3>Finalidades secundarias</h3>
                <ul>
                    <li><strong>Registro y video grabación de visitantes a las instalaciones:</strong> Por motivos de seguridad. Será tratada con fines estadísticos, de seguridad y vigilancia durante el tiempo que dure su estancia en el edificio, en su caso, detectar algún ilícito, o demostrar en controversias o requerimientos judiciales y/o administrativos, la estancia o no de dichas personas. En caso de negativa al registro y video grabación, por motivos de seguridad se les impedirá el acceso a las instalaciones. Las bitácoras de registro de accesos y candidatos serán resguardadas durante 3 meses.</li>
                </ul>

                <!-- 2 -->
                <h2><span class="num">2</span> ¿Qué Datos Personales Recabamos y Utilizamos de Usted?</h2>
                <p>Las categorías de datos personales a recabar y sujetas a tratamiento son:</p>
                <ul>
                    <li><strong>Datos de identificación:</strong> Nombre completo, edad, fecha de nacimiento, género, estado civil, domicilio, nacionalidad, correo electrónico, teléfono particular, fijo y celular, RFC, CURP, documento migratorio (en su caso), Número de Seguridad Social, fotografía, imagen, firma.</li>
                    <li><strong>Datos académicos:</strong> Educación, idiomas, aptitudes y habilidades.</li>
                    <li><strong>Datos laborales:</strong> Antecedentes y referencias laborales.</li>
                    <li><strong>Datos económicos:</strong> Los que se deriven de estudios socio-económicos.</li>
                    <li><strong>Datos de terceros:</strong> Antecedentes laborales, referencias personales y laborales.</li>
                    <li><strong>Datos fiscales:</strong> Tratándose de la prestación de servicios como proveedor de GRUPO VANGUARDIA, copia de su Alta en Hacienda.</li>
                </ul>

                <h3>Datos Sensibles</h3>
                <ul>
                    <li><strong>Datos de salud:</strong> Los cuales se recaban a través de los estudios psicométricos que se efectúan al candidato.</li>
                </ul>

                <!-- 3 -->
                <h2><span class="num">3</span> Consentimiento</h2>
                <p>De acuerdo a lo anterior, el titular otorga su consentimiento por escrito para que sus datos personales sean tratados conforme a lo señalado en el presente aviso de privacidad.</p>

                <!-- 4 -->
                <h2><span class="num">4</span> Medios por los que Grupo Vanguardia Obtiene sus Datos</h2>
                <p>Le informamos que GRUPO VANGUARDIA obtendrá sus datos personales a través de las siguientes formas:</p>
                <ol>
                    <li><strong>Personalmente:</strong> Cuando usted sea colaborador o solicite empleo, por medio del llenado de la solicitud de empleo que GRUPO VANGUARDIA proporciona.</li>
                    <li><strong>Directa:</strong> Cuando nos proporciona sus datos para solicitar empleo por medio de los portales electrónicos en los que GRUPO VANGUARDIA publica sus ofertas de empleo o cuando nos hace llegar su currículum vitae por correo electrónico.</li>
                    <li><strong>Indirecta:</strong> De cualquier otra fuente de información disponibles o que sean permitidas por la Ley.</li>
                </ol>

                <!-- 5 -->
                <h2><span class="num">5</span> Uso de Cookies y Web Beacons</h2>
                <p>Le informamos que en GRUPO VANGUARDIA no recabamos datos personales a través del uso de Cookies o Web Beacons, y otras tecnologías para obtener información personal de usted, como pudiera ser la siguiente:</p>
                <ul>
                    <li>Su tipo de navegador y sistema operativo.</li>
                    <li>Las páginas de Internet que visita.</li>
                    <li>Los vínculos que sigue.</li>
                    <li>La dirección IP.</li>
                    <li>El sitio que visitó antes de entrar al nuestro.</li>
                </ul>

                <!-- 6 -->
                <h2><span class="num">6</span> Medidas de Seguridad Implementadas</h2>
                <p>Para la protección de sus datos personales hemos instrumentado medidas de seguridad de carácter administrativo, físico y técnico con el objeto de evitar pérdidas, mal uso o alteración de su información.</p>

                <!-- 7 -->
                <h2><span class="num">7</span> Transferencia de Datos Personales</h2>
                <p>Le informamos que sus datos personales podrán transferirse a terceros mexicanos y/o extranjeros y para los siguientes fines:</p>
                <ol>
                    <li>Las autoridades competentes para el cumplimiento de las obligaciones legales que se derivan de la relación contractual entre el titular de datos personales y el responsable.</li>
                    <li>Terceros, clientes de GRUPO VANGUARDIA, para dar cumplimiento a las obligaciones contractuales adquiridas por parte de GRUPO VANGUARDIA, para la prestación del servicio.</li>
                    <li>Terceros que soliciten referencias laborales de empleados y ex‑empleados de GRUPO VANGUARDIA.</li>
                    <li>Terceros derivados de un reestructura corporativa, incluyendo, la fusión, consolidación, venta, liquidación o transferencia de activos.</li>
                    <li>Otras transmisiones previstas en la Ley citada y su Reglamento.</li>
                    <li>Los terceros y las entidades receptores de datos personales, asumen las mismas obligaciones y/o responsabilidades de GRUPO VANGUARDIA, de conformidad con lo descrito en el presente Aviso de Privacidad.</li>
                </ol>
                <p>GRUPO VANGUARDIA se compromete a no transferir su información personal a terceros, sin su consentimiento, salvo las excepciones previstas en el artículo 37 de la Ley Federal de Protección de Datos Personales en Posesión de los Particulares.</p>

                <!-- 8 -->
                <h2><span class="num">8</span> Oposición a la Transferencia de sus Datos Personales</h2>
                <p>Para el caso que Usted se oponga a la transferencia de sus datos personales, tendrá 5 días naturales, a partir de que tenga conocimiento de este aviso de privacidad, para manifestar su oposición mediante documento escrito y dirigido al encargado indicado en este instrumento para el ejercicio del Derecho de ARCO. De no hacerlo, se entenderá que está otorgando su consentimiento para realizar la transferencia de sus datos.</p>

                <!-- 9 -->
                <h2><span class="num">9</span> Derecho ARCO</h2>
                <p>Usted o su representante legal tienen derecho a conocer qué datos personales tenemos de usted, para qué los utilizamos y las condiciones de uso que les damos (<strong>Acceso</strong>). Asimismo, es su derecho solicitar la corrección de su información personal en caso de que esté desactualizada, sea inexacta o incompleta (<strong>Rectificación</strong>); que la eliminemos de nuestros registros o bases de datos cuando considere que la misma no está siendo utilizada conforme a los principios, deberes y obligaciones previstas en la Ley (<strong>Cancelación</strong>); así como oponerse al uso de sus datos personales para fines específicos (<strong>Oposición</strong>).</p>
                <p>Las únicas personas facultadas para ejercer el derecho de ARCO, es el Titular de los Datos Personales o su Representante Legal, quien deberá ejercerlo ante el responsable del tratamiento de datos personales.</p>

                <h3>Procedimiento y Requisitos para el Ejercicio de los Derechos ARCO</h3>
                <p>Requisitar el formato de solicitud de derecho ARCO <em>GV FOR GDP 007</em>, el cual puede solicitar al correo: <a href="mailto:comentarios@ccgvic.com">comentarios@ccgvic.com</a>, y entregarse personalmente en Calz. de Tlalpan no. 609, Col. Álamos, C.P. 03400, Alcaldía Benito Juárez, CDMX o vía correo electrónico en la dirección: <a href="mailto:comentarios@ccgvic.com">comentarios@ccgvic.com</a>, adjuntando la siguiente documentación:</p>
                <ol>
                    <li>Identificación oficial con la que acredite su personalidad (Credencial para votar emitida por el INE, Pasaporte vigente, Cédula Profesional, o en caso de ser de nacionalidad extranjera, su documento migratorio vigente).</li>
                    <li>En caso de no ser el titular quien presente la solicitud, el documento que acredite la existencia de la representación, es decir instrumento público o carta poder firmada ante dos testigos, junto con la identificación del titular y del representante legal.</li>
                    <li>Descripción clara y precisa de los datos personales respecto de los que requiere ejercer sus Derechos ARCO, precisando si requiere actualizar, rectificar, cancelar u oponerse al uso de sus datos, así como las razones por las que efectúa su solicitud.</li>
                    <li>Cualquier documento o información que facilite la localización de sus datos personales que se encuentran en propiedad de GRUPO VANGUARDIA.</li>
                    <li>En caso de solicitar la rectificación de datos, se indicarán las modificaciones a efectuarse y se aportará la documentación que sustente su petición.</li>
                    <li>Indicar el medio y forma en que podremos contactarlo para notificarle la respuesta a su solicitud.</li>
                </ol>

                <a href="https://gpovanguardia.com.mx/wp-content/uploads/2026/01/GV-FOR-GDP-007-Formato-Derecho-ARCO-v2.pdf" target="_blank" rel="noopener" class="download-btn">
                    <i class="fas fa-file-download"></i> Descargar formato de derechos ARCO
                </a>

                <h3>Encargado de Atención a la Solicitud</h3>
                <p>El Departamento Jurídico de GRUPO VANGUARDIA es el responsable de dar trámite a las solicitudes de los titulares para el ejercicio de los derechos contenidos en la Ley Federal de Protección de Datos Personales en Posesión de Particulares.</p>

                <h3>Plazo para la Atención de Solicitudes</h3>
                <p>El Departamento Jurídico de GRUPO VANGUARDIA responderá su solicitud en un término de <strong>20 (veinte) días</strong> contados a partir de que se le envíe acuse de recibo de la misma.</p>
                <p>Cuando la solicitud sea procedente y se hayan llevado a cabo los cotejos correspondientes, los términos para llevar a cabo la solicitud serán los siguientes:</p>
                <ol>
                    <li>Para el acceso de los datos: dentro de un plazo de 15 (quince) días contados a partir de la respuesta afirmativa.</li>
                    <li>Para la rectificación de los datos: dentro de un plazo de 15 (quince) días contados a partir de la respuesta afirmativa.</li>
                    <li>Para la cancelación u oposición de los datos: se hará primero el bloqueo de los mismos, previo cotejo de la documentación original requerida. En caso de respuesta afirmativa, dentro de un plazo de 15 (quince) días contados a partir de dicha respuesta.</li>
                </ol>

                <h3>Negativa al Ejercicio de Derechos ARCO</h3>
                <p>GRUPO VANGUARDIA podrá negar el ejercicio de los Derechos ARCO, en los siguientes supuestos:</p>
                <ul>
                    <li>a) Cuando usted no sea el titular de los datos personales o no haya acreditado la representación del titular.</li>
                    <li>b) Cuando sus datos personales no obren en la base de datos de la empresa.</li>
                    <li>c) Cuando se lesionen los derechos de un tercero.</li>
                    <li>d) Cuando exista un impedimento legal o la resolución de una autoridad competente que restrinja sus Derechos ARCO.</li>
                    <li>e) Cuando la cancelación u oposición haya sido previamente realizada.</li>
                </ul>
                <div class="legal-note">
                    &ldquo;Artículo 10 LFPDPPP.&mdash; No será necesario el consentimiento para el tratamiento de los datos personales cuando: Tenga el propósito de cumplir obligaciones derivadas de una relación jurídica entre el titular y el responsable&hellip;&rdquo;
                </div>

                <!-- 10 -->
                <h2><span class="num">10</span> Revocación del Consentimiento</h2>
                <p>Usted podrá revocar su consentimiento que, en su caso, haya otorgado a GRUPO VANGUARDIA para el tratamiento de sus datos personales mediante escrito entregado de forma personal al Encargado, siempre y cuando no sean necesarios para cumplimentar las finalidades indispensables antes descritas, dentro de los límites previstos en ley.</p>
                <p>Asimismo, usted deberá considerar que, para ciertos fines, la revocación de consentimiento implicará que no le sigamos prestando el servicio que nos solicitó o la conclusión de la relación con nosotros.</p>

                <!-- 11 -->
                <h2><span class="num">11</span> Obligaciones como Encargado del Tratamiento de Datos Personales</h2>
                <p>GRUPO VANGUARDIA recibe de terceros, transferencias de datos personales de titulares que tienen relaciones jurídicas pendientes de cumplir con ellos o para cumplir con los diferentes servicios para lo cual nos contratan los terceros. De estos datos, GRUPO VANGUARDIA es ENCARGADO y por Ley está impedido para resolver derechos de ARCO.</p>
                <p>En estos supuestos si usted desea ejercer sus derechos de ARCO, lo debe hacer ante el Responsable de dicho tratamiento, de acuerdo al Aviso de Privacidad que le dio a conocer el Responsable de sus datos.</p>

                <!-- 12 -->
                <h2><span class="num">12</span> Vigencia de la Información</h2>
                <ul>
                    <li><strong>a) Reclutamiento, selección y contratación de personal, así como selección de proveedores:</strong> Serán destruidos a los 24 meses después de la conclusión de las obligaciones contractuales o de aquellas que se hayan generado derivado del proceso de reclutamiento y que no fueron contratados. Salvo el nombre mismo que serán utilizados para efectos de referencias laborales.</li>
                    <li><strong>b) Registro de Visitantes a las instalaciones de GRUPO VANGUARDIA:</strong> Serán destruidos y/o eliminados dentro del plazo que la organización estipule a partir de la visita del titular.</li>
                </ul>

                <!-- 13 -->
                <h2><span class="num">13</span> Aceptación de los Términos</h2>
                <p>Este Aviso de Privacidad forma un acuerdo jurídicamente válido y por tanto se entiende que usted acepta el tratamiento de sus Datos Personales, si en un plazo de <strong>5 días</strong> a partir de que tenga conocimiento de dicho Aviso de Privacidad, no manifiesta su oposición.</p>

                <!-- 14 -->
                <h2><span class="num">14</span> Cambios al Aviso de Privacidad</h2>
                <p>Cualquier cambio que se realice al presente aviso de privacidad, será comunicado mediante publicación en su página de internet:</p>
                <p><a href="https://gpovanguardia.com.mx/aviso-de-privacidad/" target="_blank" rel="noopener">https://gpovanguardia.com.mx/aviso-de-privacidad/</a></p>

                <!-- 15 -->
                <h2><span class="num">15</span> Encargado en la Protección de los Datos Personales</h2>
                <p>El encargado en la protección de los datos personales dentro de GRUPO VANGUARDIA es:</p>
                <ul>
                    <li><strong>Jeniffer Haide López Romero</strong></li>
                    <li>Correo electrónico: <a href="mailto:comentarios@ccgvic.com">comentarios@ccgvic.com</a></li>
                </ul>
                <p>Si requiere mayor información, envíe sus dudas al correo electrónico: <a href="mailto:comentarios@ccgvic.com">comentarios@ccgvic.com</a>.</p>
                <p><strong>Actualización de Aviso de Privacidad: 30 de mayo de 2025.</strong></p>
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
                    <div class="footer-socials">
                        <a href="https://www.facebook.com/callcentergrupovanguardia" target="_blank" rel="noopener" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.linkedin.com/company/gpo-vanguardia" target="_blank" rel="noopener" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://www.instagram.com/grupovanguardia" target="_blank" rel="noopener" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="https://twitter.com/grupovanguardia" target="_blank" rel="noopener" title="Twitter / X"><i class="fab fa-x-twitter"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h6>Navegación</h6>
                    <ul>
                        <li><a href="{{ route('home') }}">Inicio</a></li>
                        <li><a href="{{ route('home') }}#proposito">Misión y Visión</a></li>
                        <li><a href="{{ route('servicios') }}">Servicios</a></li>
                        <li><a href="{{ route('clientes') }}">Clientes</a></li>
                        <li><a href="{{ route('contacto') }}">Contacto</a></li>
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
                        <li><a href="mailto:soporte@ccgvic.com"><i class="fas fa-envelope"></i>soporte@ccgvic.com</a></li>
                        <li><a href="{{ route('contacto') }}"><i class="fas fa-map-marker-alt"></i>CDMX, México</a></li>
                        <li><a href="{{ route('aviso') }}"><i class="fas fa-shield-alt"></i>Aviso de privacidad</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Grupo Vanguardia. Todos los derechos reservados. &middot; <a href="{{ route('terminos') }}" style="color: rgba(255,255,255,0.55); text-decoration: none;">Términos y Condiciones</a> &middot; <a href="{{ route('aviso') }}" style="color: rgba(255,255,255,0.55); text-decoration: none;">Aviso de Privacidad</a></p>
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
