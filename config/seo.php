<?php

// ============================================
// CONFIGURACIÓN SEO CENTRALIZADA
// Todos los meta datos por defecto del sitio
// ============================================

return [
    'site_name' => 'Grupo Vanguardia',
    'site_url'  => env('APP_URL', 'https://gpovanguardia.com.mx'),

    // META TAGS POR DEFECTO (se usan si la página no define los suyos)
    'defaults' => [
        'title'            => 'Contact Center y BPO en México | Grupo Vanguardia CDMX',
        'meta_description' => 'Grupo Vanguardia: líderes en contact center, BPO y call center outsourcing en CDMX. Soluciones con IA, desarrollo web y ciberseguridad. ¡Cotiza gratis!',
        'meta_keywords'    => 'contact center México, BPO México, call center outsourcing CDMX, outsourcing procesos negocio',
        'og_image'         => '/img/og-default.jpg',
        'robots'           => 'index, follow',
    ],

    // DATOS DE LA EMPRESA (para Schema Markup)
    'company' => [
        'legal_name'  => 'Grupo Vanguardia en Información y Conocimiento S.A. de C.V.',
        'description' => 'Empresa líder en contact center, BPO, desarrollo web, ciberseguridad e inteligencia artificial en Ciudad de México.',
        'phone'       => '+525585263542',
        'phone_display' => '55 8526 3542',
        'email'       => 'soporte@ccgvic.com',
        'address'     => [
            'street'   => 'Calz. De Tlalpan 609',
            'city'     => 'Ciudad de México',
            'region'   => 'CDMX',
            'zip'      => '14000',
            'country'  => 'MX',
        ],
        'geo' => [
            'latitude'  => 19.3565,
            'longitude' => -99.1437,
        ],
        'social' => [
            'facebook'  => 'https://www.facebook.com/callcentergrupovanguardia',
            'instagram' => 'https://www.instagram.com/gpovanguardia',
            'linkedin'  => 'https://www.linkedin.com/company/gpo-vanguardia',
        ],
        'opening_hours' => [
            'days'  => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
            'opens' => '08:00',
            'closes' => '18:00',
        ],
    ],

    // META TAGS POR PÁGINA (sobreescriben los defaults)
    'pages' => [
        'home' => [
            'title'            => 'Contact Center y BPO en México | Grupo Vanguardia CDMX',
            'meta_description' => 'Grupo Vanguardia: líderes en contact center, BPO y call center outsourcing en CDMX. Soluciones con IA, desarrollo web y ciberseguridad. ¡Cotiza gratis!',
            'meta_keywords'    => 'contact center México, BPO México, call center outsourcing CDMX, outsourcing procesos negocio, chatbot IA México',
        ],
        'servicios' => [
            'title'            => 'Servicios de Contact Center, BPO y Tecnología | Grupo Vanguardia',
            'meta_description' => 'Descubre nuestros servicios: call center outsourcing, BPO, inteligencia artificial, desarrollo web, ciberseguridad y marketing digital en CDMX.',
            'meta_keywords'    => 'servicios contact center, BPO outsourcing, desarrollo web México, ciberseguridad empresas',
        ],
        'call-center' => [
            'title'            => 'Call Center Outsourcing en México | Servicio Omnicanal | Grupo Vanguardia',
            'meta_description' => 'Servicio de call center outsourcing en CDMX. Atención omnicanal: teléfono, chat, email, WhatsApp. Reduce costos 50%. Agentes capacitados 24/7. ¡Cotiza!',
            'meta_keywords'    => 'call center outsourcing México, call center omnicanal CDMX, servicio call center empresas, tercerizar call center',
        ],
        'bpo' => [
            'title'            => 'BPO Outsourcing en México | Tercerización de Procesos | Grupo Vanguardia',
            'meta_description' => 'Servicios de BPO (Business Process Outsourcing) en CDMX. Tercerización de atención al cliente, cobranza, telemarketing y back office. Ahorra hasta 50%.',
            'meta_keywords'    => 'BPO México, outsourcing procesos negocio, tercerización CDMX, business process outsourcing México',
        ],
        'inteligencia-artificial' => [
            'title'            => 'Chatbots e Inteligencia Artificial para Empresas | Grupo Vanguardia',
            'meta_description' => 'Automatiza tu atención al cliente con chatbots inteligentes y procesamiento de lenguaje natural (PNL). Respuestas 24/7, empáticas y eficientes. CDMX.',
            'meta_keywords'    => 'chatbot inteligencia artificial México, automatización atención cliente, PNL chatbot empresas, chatbot 24/7',
        ],
        'desarrollo-web' => [
            'title'            => 'Desarrollo Web y Software a Medida en México | Grupo Vanguardia',
            'meta_description' => 'Desarrollo de sistemas ERP, CRM, aplicaciones web y software a medida. 15+ años de experiencia. Fábrica de software en CDMX. Cotiza tu proyecto.',
            'meta_keywords'    => 'desarrollo web México, software a medida CDMX, desarrollo ERP CRM, fábrica software México',
        ],
        'seguridad-informatica' => [
            'title'            => 'Ciberseguridad y Seguridad Informática para Empresas | Grupo Vanguardia',
            'meta_description' => 'Servicios de ciberseguridad: análisis de vulnerabilidades, pentesting, forensia digital y SOC avanzados. Protege tu empresa. Certificadora en CDMX.',
            'meta_keywords'    => 'ciberseguridad empresas México, análisis vulnerabilidades, pentesting CDMX, seguridad informática',
        ],
        'agencia-digital' => [
            'title'            => 'Agencia de Marketing Digital en CDMX | Grupo Vanguardia',
            'meta_description' => 'Agencia de marketing digital en Ciudad de México. SEO, SEM, redes sociales, email marketing y generación de leads para hacer crecer tu negocio.',
            'meta_keywords'    => 'agencia marketing digital CDMX, SEO México, marketing online empresas, publicidad digital',
        ],
        'cctv' => [
            'title'            => 'Sistemas CCTV y Videovigilancia Empresarial | Grupo Vanguardia',
            'meta_description' => 'Instalación y monitoreo de sistemas CCTV y videovigilancia para empresas en CDMX. Seguridad integral con tecnología de punta.',
            'meta_keywords'    => 'CCTV empresarial México, videovigilancia CDMX, cámaras seguridad empresas',
        ],
        'clientes' => [
            'title'            => 'Nuestros Clientes y Casos de Éxito | Grupo Vanguardia',
            'meta_description' => 'Conoce los casos de éxito de Grupo Vanguardia. Empresas que han optimizado su operación con nuestros servicios de contact center, BPO y tecnología.',
        ],
        'nosotros' => [
            'title'            => 'Sobre Nosotros | Grupo Vanguardia en Información y Conocimiento',
            'meta_description' => 'Conoce a Grupo Vanguardia: nuestra misión, visión, valores y el equipo detrás de la empresa líder en BPO y contact center en Ciudad de México.',
        ],
        'contacto' => [
            'title'            => 'Contacto | Grupo Vanguardia - Contact Center CDMX',
            'meta_description' => 'Contáctanos para cotizar servicios de contact center, BPO, desarrollo web y ciberseguridad. Calz. De Tlalpan 609, CDMX. Tel: 55 8526 3542.',
        ],
        'cotizacion' => [
            'title'            => 'Solicitar Cotización | Contact Center y BPO | Grupo Vanguardia',
            'meta_description' => 'Solicita una cotización gratuita para servicios de contact center, BPO, desarrollo web o ciberseguridad. Respuesta en menos de 24 horas.',
        ],
        'chatbots' => [
            'title'            => 'Chatbots e Inteligencia Artificial para Empresas | Grupo Vanguardia',
            'meta_description' => 'Automatiza tu atención al cliente con chatbots inteligentes y procesamiento de lenguaje natural (PNL). Respuestas 24/7, empáticas y eficientes.',
            'meta_keywords'    => 'chatbot IA México, inteligencia artificial empresas, automatización atención cliente, chatbot WhatsApp',
        ],
        'mesa-servicios' => [
            'title'            => 'Mesa de Servicios IT | Soporte Técnico Outsourcing | Grupo Vanguardia',
            'meta_description' => 'Mesa de servicios y soporte técnico outsourcing en CDMX. Help desk nivel 1, 2 y 3. ITIL. Reduce tiempos de respuesta y mejora la experiencia de usuario.',
            'meta_keywords'    => 'mesa de servicios IT México, help desk outsourcing, soporte técnico empresarial CDMX, ITIL',
        ],
        'bolsa' => [
            'title'            => 'Bolsa de Empleo | Trabaja en Grupo Vanguardia CDMX',
            'meta_description' => 'Únete a Grupo Vanguardia. Vacantes en contact center, tecnología, desarrollo web y más. Envía tu CV. Trabajamos en CDMX.',
            'meta_keywords'    => 'empleo contact center CDMX, vacantes tecnología México, trabajo BPO',
        ],
        'blog' => [
            'title'            => 'Blog | Noticias y Artículos de Tecnología | Grupo Vanguardia',
            'meta_description' => 'Lee artículos sobre contact center, BPO, inteligencia artificial, ciberseguridad y tendencias tecnológicas en el blog de Grupo Vanguardia.',
            'meta_keywords'    => 'blog tecnología México, artículos contact center, noticias BPO, tendencias IA',
        ],
        'terminos' => [
            'title'            => 'Términos y Condiciones | Grupo Vanguardia',
            'meta_description' => 'Términos y condiciones de uso del sitio web de Grupo Vanguardia en Información y Conocimiento S.A. de C.V.',
            'robots'           => 'noindex, follow',
        ],
        'aviso' => [
            'title'            => 'Aviso de Privacidad | Grupo Vanguardia',
            'meta_description' => 'Aviso de privacidad integral de Grupo Vanguardia. Conoce cómo protegemos tus datos personales conforme a la LFPDPPP.',
            'robots'           => 'noindex, follow',
        ],
    ],
];
