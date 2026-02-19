# GPO Vanguardia — Instrucciones del Proyecto

## Descripción General
Sitio web corporativo para **Grupo Vanguardia**, empresa especializada en BPO, IA/NLP, ciberseguridad y soluciones tecnológicas. Construido con Laravel 12 + Blade + Bootstrap 5.3.

---

## Stack Tecnológico

| Componente | Tecnología |
|---|---|
| Backend | Laravel 12.52.0, PHP 8.3 |
| Frontend | Blade templates, Bootstrap 5.3 (CDN), Font Awesome 6.4 |
| Fuente | Montserrat (Google Fonts, pesos 300-900) |
| Base de datos | MySQL (servidor separado por seguridad) |
| Autenticación | Laravel Breeze (Blade stack), registro público deshabilitado |
| Deploy | Docker → Coolify v4 (Traefik proxy) |

---

## Configuración Local (Desarrollo)

### Requisitos
- PHP 8.3+
- Composer
- Node.js 20+
- MySQL 8.0+
- Git
- Laragon (recomendado en Windows, incluye MySQL)

### Instalación desde cero

```bash
# 1. Clonar repositorio
git clone <repo-url> gpo-vanguardia
cd gpo-vanguardia

# 2. Instalar dependencias PHP
composer install

# 3. Configurar entorno
cp .env.example .env
# Editar .env para desarrollo local:
#   APP_ENV=local
#   APP_DEBUG=true
#   DB_CONNECTION=mysql
#   DB_HOST=127.0.0.1
#   DB_PORT=3306
#   DB_DATABASE=gpo_vanguardia
#   DB_USERNAME=root
#   DB_PASSWORD=
#   APP_URL=http://127.0.0.1:8001

# 4. Crear base de datos MySQL
# En Laragon: abrir HeidiSQL o terminal MySQL y ejecutar:
#   CREATE DATABASE gpo_vanguardia CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# 5. Generar key y migrar
php artisan key:generate
php artisan migrate

# 6. Sembrar datos iniciales
php artisan db:seed --class=ContentSeeder

# 7. Instalar dependencias frontend
npm install
npm run build

# 8. Crear enlace de storage
php artisan storage:link

# 9. Iniciar servidor
php artisan serve --port=8001
```

### Acceso al Panel Admin (local)
- **URL**: http://127.0.0.1:8001/gpo-panel-v25
- **Email**: admin@gpovanguardia.com
- **Password**: Vanguardia2025!

> ⚠️ **Seguridad**: La URL del admin NO es `/admin`. Usa el prefijo configurado en `ADMIN_PREFIX` (.env).
> - `/admin` devuelve 404 (honeypot para bots/scanners)
> - Login tiene rate limit: 5 intentos/minuto por IP
> - Cambiar `ADMIN_PREFIX` en producción para mayor seguridad

#### Funcionalidades del panel admin:
- CRUD de Blog (posts)
- CRUD de Testimonios
- CRUD de Valores Corporativos
- CRUD de Galería de Imágenes
- CRUD de Servicios
- Ver y gestionar mensajes de contacto
- CRUD de Redes Sociales
- Configuración de Webhooks (n8n)

> Para crear el usuario admin en local, ejecutar:
> ```bash
> php artisan tinker --execute="App\Models\User::create(['name'=>'Admin','email'=>'admin@gpovanguardia.com','password'=>bcrypt('Vanguardia2025!')])"
> ```

### Instrucciones de Acceso Rápido

#### Desarrollo Local
1. Iniciar servidor: `php artisan serve --port=8001`
2. **Web pública**: http://127.0.0.1:8001
3. **Panel admin**: http://127.0.0.1:8001/gpo-panel-v25
4. **Credenciales**: admin@gpovanguardia.com / Vanguardia2025!

#### Producción
1. **Web pública**: https://tu-dominio.com
2. **Panel admin**: https://tu-dominio.com/{ADMIN_PREFIX}
3. Cambiar `ADMIN_PREFIX` en `.env` a algo único para el servidor
4. Cambiar la contraseña del admin después del primer deploy

#### Medidas de Seguridad
| Medida | Detalle |
|---|---|
| URL ofuscada | El panel NO está en `/admin` — prefijo configurable via `ADMIN_PREFIX` en `.env` |
| Honeypot | `/admin` y `/admin/*` devuelven error 404 (engaña bots/scanners) |
| Rate limiting | Login acepta máximo 5 intentos por minuto por IP |
| Registro deshabilitado | Solo se crea admin via seeder o `php artisan tinker` |
| Bcrypt | Contraseñas con 12 rounds de hashing |
| noindex/nofollow | Página de login excluida de motores de búsqueda |

---



## Estructura del Proyecto
```
gpo-vanguardia/
├── app/
│   ├── Models/                    → Servicio, Post, GaleriaImagen, Testimonio, RedSocial, Contact, ValorCorporativo
│   ├── Helpers/                   → SeoHelper.php (funciones SEO centralizadas)
│   └── Http/Controllers/
│       ├── HomeController.php     → Landing page, CCTV, Términos
│       ├── ContactController.php  → Formulario de contacto (AJAX)
│       ├── BlogController.php     → Blog público
│       └── Admin/                 → CRUD admin panel
│           ├── DashboardController.php
│           ├── ServicioController.php
│           ├── PostController.php
│           ├── GaleriaController.php
│           ├── TestimonioController.php
│           ├── RedSocialController.php
│           ├── ContactoAdminController.php
│           └── ValorController.php
├── config/
│   └── seo.php                    → Configuración centralizada de meta tags y schema.org
├── resources/views/
│   ├── components/seo/            → Blade components SEO (meta-tags, schema-organization, schema-local-business)
│   ├── layouts/app.blade.php      → Layout principal con inclusión automática de meta tags y schema
│   ├── home.blade.php             → Landing page principal (todas las secciones)
│   ├── servicios.blade.php        → Página de servicios
│   ├── clientes.blade.php         → Casos de éxito
│   ├── contacto.blade.php         → Contacto con form AJAX + mapa
│   ├── call-center.blade.php      → Call Center Omnicanal
│   ├── chatbots.blade.php         → Chat Bots y AI
│   ├── mesa-servicios.blade.php   → Mesa de Servicios
│   ├── cctv.blade.php             → CCTV + RFID
│   ├── terminos.blade.php         → Términos y Condiciones
│   ├── aviso.blade.php            → Aviso de Privacidad (15 secciones)
│   └── admin/                     → Panel admin (layouts + CRUD views)
│       ├── posts/ (CRUD Blog)
│       ├── testimonios/ (CRUD Testimonios)
│       ├── contactos/ (ver y gestionar mensajes)
│       └── redes/ (CRUD Redes Sociales)
│   └── blog/                      → Blog index + show
├── routes/web.php                 → Todas las rutas
├── database/
│   ├── migrations/                → Tablas: servicios, posts, galeria_imagenes, testimonios, redes_sociales, contacts, valores_corporativos
│   └── seeders/ContentSeeder.php  → Datos iniciales
├── docker/                        → Dockerfile, nginx.conf, supervisord.conf, entrypoint.sh
├── public/images/                 → Logos, casos, imágenes estáticas
├── MEMORY.md                      → Memoria del proyecto (historial de sesiones)
└── instructions.md                → Este archivo
```

---

## SEO Centralizado y Personalización de Meta Tags

### Configuración
- Todos los meta tags y datos de empresa están centralizados en `config/seo.php`.
- El helper `App\Helpers\SeoHelper` permite obtener los meta tags por página y los datos de schema.org.
- Los componentes Blade en `resources/views/components/seo/` generan los meta tags y schema automáticamente.
- El layout `layouts/app.blade.php` incluye estos componentes en el `<head>`.

### Personalización por Página
- Para personalizar los meta tags de una página, pasa la variable `$page` (clave de la página en config/seo.php) y opcionalmente `$meta` (array de overrides) desde el controlador o la vista:

```php
// Ejemplo en un controlador
return view('servicios', [
   'page' => 'servicios',
   'meta' => [
      'title' => 'Título personalizado',
      'meta_description' => 'Descripción SEO personalizada',
   ]
]);
```

---

## Arquitectura de Layouts

El proyecto tiene **3 tipos de vistas** con diferentes estructuras:

### 1. Páginas públicas standalone (home, servicios, cctv, etc.)
- **NO usan layout compartido**
- Todo inline: `<!DOCTYPE html>`, CSS en `<style>`, navbar, footer
- Archivos: `home.blade.php`, `servicios.blade.php`, `cctv.blade.php`, `contacto.blade.php`, etc.

### 2. Blog público (`/blog`)
- **USA**: `@extends('layouts.public')`
- Layout incluye navbar público + footer completo
- Archivos: `blog/index.blade.php`, `blog/show.blade.php`

### 3. Admin panel (`/admin`)
- **USA**: `@extends('layouts.app')` (Breeze)
- Layout incluye navigation admin + componentes SEO
- Solo para usuarios autenticados

### ⚠️ REGLAS CRÍTICAS:

1. **NUNCA** usar `layouts/app.blade.php` para páginas públicas (causa errores de auth y SEO)
2. El blog SIEMPRE debe usar `layouts/public.blade.php`
3. Al crear nuevas páginas públicas, elegir:
   - Standalone (como home.blade.php) para landing pages
   - `@extends('layouts.public')` para páginas que necesiten navbar/footer consistente

### Componentes SEO
- Los componentes en `components/seo/` usan `data_get()` para acceso seguro a arrays anidados
- Solo se incluyen en `layouts/app.blade.php` (admin)
- NO incluir en páginas públicas standalone

### Blog — Notas importantes
- El formulario de creación de posts (`admin/posts/form.blade.php`) tiene el checkbox "Publicado" **marcado por defecto** para que los posts nuevos sean visibles automáticamente en el frontend.
- Campo **Categoría** agregado al formulario de posts; se almacena en `posts.categoria`.
- Filtros en `/blog`: categoría, buscador (título/extracto/contenido) y rango de fechas (desde/hasta). La paginación preserva los filtros.
- Las imágenes de los posts son **clickeables** y llevan al artículo en: home (sección Blog), blog/index, y artículos relacionados en blog/show.
- El scope `publicados()` del modelo Post filtra por `publicado=true` Y `fecha_publicacion <= now()`.
- **Migración aplicada**: `2026_02_18_000001_add_categoria_to_posts_table` (ejecutada).

---

## Rutas del Sitio

### Públicas

| Ruta | Vista | Descripción |
|---|---|---|
| `/` | home.blade.php | Landing page (Hero, Propósito, Casos, Servicios, Valores, Testimonios, Contacto, Footer) |
| `/servicios` | servicios.blade.php | Todos los servicios (BPO, Desarrollo Web, Ciberseguridad, Agencia Digital) |
| `/clientes` | clientes.blade.php | Casos de éxito (VBike, Econduce, Grin) |
| `/contacto` | contacto.blade.php | Formulario AJAX + mapa + redes sociales |
| `/call-center-omnicanal` | call-center.blade.php | Servicio Call Center |
| `/chat-bots-y-ai` | chatbots.blade.php | Servicio Chat Bots y AI |
| `/mesa-de-servicios` | mesa-servicios.blade.php | Servicio Mesa de Servicios |
| `/cctv` | cctv.blade.php | Servicio CCTV + RFID |
| `/bolsa-de-empleo` | bolsa.blade.php | Bolsa de empleo (formulario con carga de CV) |
| `/terminos-y-condiciones` | terminos.blade.php | Términos legales (8 artículos) |
| `/aviso-de-privacidad` | aviso.blade.php | Aviso de Privacidad Integral (15 secciones) |
| `/blog` | blog/index.blade.php | Listado de artículos |
| `/blog/{slug}` | blog/show.blade.php | Artículo individual |

### Admin (requiere autenticación, prefijo configurable via `ADMIN_PREFIX` en .env)

> Prefijo actual: `gpo-panel-v25`. Cambiar en `.env` para producción. `/admin*` devuelve 404.

| Ruta | Descripción |
|---|---|
| `GET /{prefix}` | Dashboard |
| `/{prefix}/servicios` | CRUD Servicios |
| `/{prefix}/posts` | CRUD Blog Posts |
| `/{prefix}/galeria` | CRUD Galería de Imágenes |
| `/{prefix}/testimonios` | CRUD Testimonios |
| `/{prefix}/valores` | CRUD Valores Corporativos |
| `/{prefix}/redes-sociales` | CRUD Redes Sociales |
| `/{prefix}/contactos` | Ver contactos recibidos |
| `PATCH /{prefix}/contactos/{id}/leido` | Marcar contacto como leído |
| `DELETE /{prefix}/contactos/{id}` | Eliminar contacto |
| `GET /{prefix}/webhooks` | Configurar webhooks n8n |
| `PUT /{prefix}/webhooks/{id}` | Actualizar webhook |
| `GET /{prefix}/webhooks/{id}/test` | Probar webhook |
| `ANY /admin*` | Honeypot → 404 |

### Contacto (POST)
- `POST /contacto` → `ContactController@store` (AJAX, throttle: 5 peticiones/minuto)
- `POST /bolsa-de-empleo` → `JobApplicationController@store` (formulario en página Bolsa de empleo; valida y guarda CV en `storage/app/public/job_applications`)

---

## Sistema de Diseño

### Colores
| Variable | Valor | Uso |
|---|---|---|
| `--primary` | `#4338CA` | Color principal (indigo) |
| Gradient | `#4338CA → #6366F1` | Heroes, badges, botones |
| `--dark` | `#0F0D2E` | Footer, sección contacto |

### Tipografía
- **Fuente principal**: Montserrat (Google Fonts)
- **Pesos**: 300 (light), 400 (regular), 500 (medium), 600 (semi-bold), 700 (bold), 800 (extra-bold), 900 (black)
- **Hero h1**: Montserrat 800, letter-spacing -0.5px
- **Títulos de sección**: Montserrat 700, con `::after` blue underline (60px × 3px)
- **Cuerpo**: Montserrat 400/500
- **Nav**: Montserrat 500/600

### Componentes UI
- **Navbar**: Fondo blanco, `border-bottom: 3px solid var(--primary)`, links oscuros, dropdown de servicios
- **Hero**: Foto de fondo + overlay azul `rgba(55,48,163,0.82)` + curva wave blanca `::after`
- **Cards**: `border-radius: 20px`, sombras suaves, gradiente en hover
- **Badges numerados**: Círculos con gradiente para listas legales
- **Footer**: 4 columnas, fondo oscuro `#0F0D2E`, iconos sociales como cuadrados redondeados
- **Breakpoints responsivos**: 991px (tablet), 575px (mobile)

---

## Información de la Empresa

| Dato | Valor |
|---|---|
| Teléfono | 55 8526 3542 |
| Email | soporte@cgpvc.com |
| Dirección | Calzada de Tlalpan 609, CDMX |
| Facebook | facebook.com/callcentergrupovanguardia |
| LinkedIn | linkedin.com/company/gpo-vanguardia |
| Instagram | @gpovanguardia |

---

## Comandos Útiles

### Desarrollo
```bash
# Iniciar servidor local
php artisan serve --port=8001

# Limpiar cachés (útil después de cambios)
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Re-sembrar datos
php artisan db:seed --class=ContentSeeder

# Crear migración
php artisan make:migration create_tabla_table

# Crear modelo con migración y controlador
php artisan make:model NombreModelo -mc
```

### Git (Windows / Laragon)
```powershell
# Agregar git al PATH (si no está disponible)
$env:PATH = "C:\laragon\bin\git\cmd;$env:PATH"

# Commit estándar
git add -A
git commit -m "tipo: descripción breve"
```

### Convenciones de commits
- `feat:` — Nueva funcionalidad
- `fix:` — Corrección de bug
- `docs:` — Documentación
- `style:` — Cambios de estilo/formato (no funcionales)
- `refactor:` — Refactoreo de código

### Docker / Producción
```bash
# Build local de Docker
docker build -t gpo-vanguardia .

# Ejecutar contenedor local
docker run -p 80:80 --env-file .env gpo-vanguardia
```

---

## Deploy en Producción (Coolify)

### Pasos
1. Crear servicio MySQL en servidor separado (por seguridad, no en el mismo servidor de la app)
2. Crear nuevo recurso Laravel apuntando al repositorio Git
3. Configurar variables de entorno:
   - `DB_CONNECTION=mysql`
   - `DB_HOST=<IP o hostname del servidor MySQL separado>`
   - `DB_PORT=3306`
   - `DB_DATABASE=gpo_vanguardia`
   - `DB_USERNAME=gpo_vanguardia`
   - `DB_PASSWORD=<contraseña segura del usuario MySQL>`
   - `APP_URL=https://tu-dominio.com`
   - `ADMIN_EMAIL=admin@gpovanguardia.com`
   - `ADMIN_PASSWORD=<contraseña segura>`
4. Configurar dominio en Coolify
5. Deploy — `entrypoint.sh` se encarga de:
   - Esperar a que MySQL esté listo
   - Ejecutar migraciones
   - Sembrar datos iniciales (solo primer deploy)
   - Crear usuario admin (si `ADMIN_PASSWORD` está configurado y no hay usuarios)
   - Cachear config, rutas y vistas
   - Crear enlace de storage
   - Iniciar Nginx + PHP-FPM vía Supervisor

---

## Convenciones de Código

### Blade Templates
- Cada página pública es un archivo `.blade.php` independiente con su propio `<head>`, navbar y footer (no usan layout compartido)
- CSS inline dentro de `<style>` en cada vista
- CDNs de Bootstrap 5.3, Font Awesome 6.4 y Google Fonts en cada `<head>`
- Navbar y footer deben ser consistentes entre todas las páginas públicas

### Nomenclatura
- **Vistas**: kebab-case (`call-center.blade.php`, `mesa-servicios.blade.php`)
- **Rutas**: kebab-case (`/aviso-de-privacidad`, `/chat-bots-y-ai`)
- **Modelos**: PascalCase singular (`Servicio`, `ValorCorporativo`)
- **Controladores**: PascalCase + Controller (`ContactoAdminController`)
- **Migraciones**: snake_case (`create_servicios_table`)

### Contenido Legal
- Términos y Condiciones: 8 artículos con badges numerados
- Aviso de Privacidad: 15 secciones con badges numerados
- Ambas páginas usan el mismo diseño: gradiente hero + card legal + badges
- Contenido extraído de gpovanguardia.com.mx

---

## ⚠️ Advertencias Importantes

### Encoding UTF-8
- **NUNCA usar PowerShell heredoc** (`@' ... '@` o `@" ... "@`) para crear archivos con caracteres en español (acentos: á, é, í, ó, ú, ñ)
- PowerShell corrompe el encoding UTF-8 convirtiendo acentos en `�`
- También convierte comillas simples `'` en dobles `''`
- **Usar siempre** la herramienta `create_file` del editor o VS Code nativo para crear/editar archivos Blade

### Servidor de desarrollo
- El servidor Laravel corre en el **puerto 8001** (`artisan serve --port=8001`)
- URL local: http://127.0.0.1:8001

### Base de datos
- Se usa **MySQL** en servidor separado (por seguridad, la BD no comparte servidor con la app)
- En desarrollo local: MySQL de Laragon (`127.0.0.1:3306`)
- En producción: servidor MySQL dedicado (IP privada o hostname interno)
- `DB_CONNECTION=mysql` en `.env`
- Charset: `utf8mb4`, Collation: `utf8mb4_unicode_ci`

---

## Archivos de Referencia

| Archivo | Propósito |
|---|---|
| `MEMORY.md` | Historial completo de sesiones de desarrollo, cambios y decisiones |
| `instructions.md` | Este archivo — guía de referencia rápida del proyecto |
| `.env.example` | Variables de entorno para producción |
| `docker/entrypoint.sh` | Script de inicialización del contenedor (migraciones, seeding, admin) |
| `docker/nginx.conf` | Configuración de Nginx para producción |
| `docker/supervisord.conf` | Supervisor para Nginx + PHP-FPM |

---

## Modelos de Base de Datos

| Modelo | Tabla | Campos principales |
|---|---|---|
| Servicio | servicios | titulo, descripcion, icono, imagen, orden, activo |
| Post | posts | titulo, slug, contenido, imagen, publicado_en |
| GaleriaImagen | galeria_imagenes | titulo, imagen, descripcion, orden |
| Testimonio | testimonios | nombre, cargo, empresa, contenido, calificacion, avatar |
| RedSocial | redes_sociales | nombre, url, icono, orden, activo |
| Contact | contacts | nombre, email, telefono, mensaje, leido |
| ValorCorporativo | valores_corporativos | titulo, descripcion, icono, orden || JobApplication | job_applications | nombre, apellido, correo, telefono, cv_path |

### Migraciones

| Archivo | Propósito |
|---|---|
| `0001_01_01_000000_create_users_table.php` | Users (Laravel default) |
| `0001_01_01_000001_create_cache_table.php` | Cache (Laravel default) |
| `0001_01_01_000002_create_jobs_table.php` | Jobs/queue (Laravel default) |
| `2026_02_17_182146_create_posts_table.php` | Blog posts |
| `2026_02_17_182146_create_servicios_table.php` | Servicios |
| `2026_02_17_182147_create_galeria_imagens_table.php` | Galería de imágenes |
| `2026_02_17_182147_create_testimonios_table.php` | Testimonios |
| `2026_02_17_182148_create_contacts_table.php` | Formulario de contacto |
| `2026_02_17_182148_create_red_socials_table.php` | Redes sociales |
| `2026_02_17_182149_create_valor_corporativos_table.php` | Valores corporativos |
| `2026_02_18_000001_add_categoria_to_posts_table.php` | Agrega `categoria` a posts |
| `2026_02_18_000002_create_job_applications_table.php` | Aplicaciones de empleo (bolsa) |
| `2026_02_18_100000_add_meta_description_to_posts_table.php` | Agrega `meta_description` a posts |

---

## Detalles Técnicos

### Sistema SEO Centralizado

#### Configuración (`config/seo.php`)
```php
return [
    'site_name' => 'Grupo Vanguardia',
    'site_url'  => env('APP_URL', 'https://gpovanguardia.com.mx'),

    'defaults' => [
        'title'            => 'Contact Center y BPO en México | Grupo Vanguardia CDMX',
        'meta_description' => '...',
        'meta_keywords'    => 'contact center México, BPO México, ...',
        'og_image'         => '/img/og-default.jpg',
        'robots'           => 'index, follow',
    ],

    'company' => [
        'legal_name'  => 'Grupo Vanguardia en Información y Conocimiento S.A. de C.V.',
        'phone'       => '+525585263542',
        'email'       => 'soporte@ccgvic.com',
        'address'     => [ 'street', 'city', 'region', 'zip', 'country' ],
        'geo'         => [ 'latitude' => 19.3565, 'longitude' => -99.1437 ],
        'social'      => [
            'facebook'  => 'https://www.facebook.com/callcentergrupovanguardia',
            'instagram' => 'https://www.instagram.com/gpovanguardia',
            'linkedin'  => 'https://www.linkedin.com/company/gpo-vanguardia',
        ],
        'opening_hours' => [ 'opens' => '08:00', 'closes' => '18:00' ],
    ],

    // 19 páginas configuradas, cada una con title, meta_description, meta_keywords
    'pages' => [
        'home', 'servicios', 'call-center', 'bpo', 'inteligencia-artificial',
        'desarrollo-web', 'seguridad-informatica', 'agencia-digital', 'cctv',
        'clientes', 'nosotros', 'contacto', 'cotizacion', 'chatbots',
        'mesa-servicios', 'bolsa', 'blog',
        'terminos' => ['robots' => 'noindex, follow'],  // No indexar
        'aviso'    => ['robots' => 'noindex, follow'],  // No indexar
    ],
];
```

#### Helper (`App\Helpers\SeoHelper`)

| Método | Firma | Retorno |
|---|---|---|
| `meta()` | `static meta($page = null, $overrides = [])` | `array` — fusiona `defaults` → config de página → overrides |
| `company()` | `static company()` | `array` — retorna `config('seo.company')` |

#### Partial SEO para páginas standalone (`partials/seo-head.blade.php`)
Usado en las 10 páginas standalone (home, servicios, clientes, contacto, call-center, chatbots, mesa-servicios, cctv, terminos, aviso):

```blade
@include('partials.seo-head', ['seoPage' => 'home'])
```

Genera automáticamente:
- Meta tags: canonical, robots, author, description, keywords
- Open Graph: site_name, locale (es_MX), title, description, image, type, url
- Twitter Card: summary_large_image
- JSON-LD Organization: nombre, url, logo, teléfono, dirección, sameAs (redes)
- JSON-LD LocalBusiness: lo anterior + geo coordinates, openingHours, priceRange

#### SEO en Blog (layouts/public.blade.php)
El layout público genera meta tags desde `@yield` sections:

```blade
@section('title', 'Mi título')
@section('description', 'Mi descripción')
@section('og_type', 'article')        {{-- Default: website --}}
@section('og_image', '/ruta/img.jpg')
@section('robots', 'noindex, follow') {{-- Default: index, follow --}}
@section('seo_extra')
  {{-- Schema.org JSON-LD aquí --}}
@endsection
```

- `blog/show.blade.php` genera schema BlogPosting + BreadcrumbList
- `blog/index.blade.php` genera schema BreadcrumbList

### ⚠️ Regla Blade + JSON-LD (CRÍTICA)

En Laravel 12, Blade interpreta `@context` y `@type` como directivas, causando error fatal:
```
unexpected end of file, expecting endif
```

**SIEMPRE escapar con doble `@@`** dentro de `<script type="application/ld+json">`:

```blade
{{-- ❌ INCORRECTO — causa error Blade --}}
"@context": "https://schema.org",
"@type": "Organization",

{{-- ✅ CORRECTO — Blade renderiza @context/@type correctamente --}}
"@@context": "https://schema.org",
"@@type": "Organization",
```

Esto aplica a: `@@context`, `@@type`, `@@id`, y cualquier propiedad JSON-LD que empiece con `@`.

---

### Sitemap Dinámico

**Controlador**: `SitemapController@index` — Ruta: `GET /sitemap.xml`

Genera XML sitemap con:
- **10 páginas estáticas** con prioridad configurada:
  - `/` (1.0, daily), `/servicios` (0.9), `/call-center-omnicanal` (0.8)
  - `/chat-bots-y-ai` (0.8), `/mesa-de-servicios` (0.8), `/cctv` (0.8)
  - `/clientes` (0.7), `/contacto` (0.7), `/blog` (0.8, daily), `/bolsa-de-empleo` (0.6)
- **Posts dinámicos**: Todos los publicados, prioridad 0.7, weekly, con `<lastmod>`

**robots.txt** (`public/robots.txt`):
```
User-agent: *
Allow: /
Disallow: /admin
Disallow: /login
Disallow: /register
Disallow: /password
Disallow: /profile
Disallow: /dashboard
Sitemap: https://gpovanguardia.com.mx/sitemap.xml
```

---

### Blog — Slug Editable y meta_description

#### Modelo Post — Slug handling
```php
// Route model binding por slug
public function getRouteKeyName(): string { return 'slug'; }

// Generación de slug único con sufijo numérico (-1, -2, etc.)
public static function generateUniqueSlug(string $title, ?int $excludeId = null): string
```

#### Campos del modelo Post
| Campo | Tipo | Descripción |
|---|---|---|
| titulo | string | Título del post |
| slug | string | URL-friendly slug (auto-generado o editado) |
| extracto | text | Resumen corto |
| categoria | string | Categoría del post |
| contenido | longText | Contenido HTML |
| imagen_portada | string | Ruta de imagen (en storage) |
| publicado | boolean | Si está visible en frontend |
| fecha_publicacion | datetime | Fecha de publicación |
| meta_description | string(160) | Meta descripción SEO (nullable) |
| user_id | foreignId | Autor |

#### Admin — Formulario de posts
- Campo slug editable con prefijo `/blog/`, auto-generado desde título vía JS
- Textarea meta_description con contador de 160 caracteres
- Validación: `slug` → nullable|max:255|alpha_dash, `meta_description` → nullable|max:160

---

### Docker / Producción (VPS)

#### Dockerfile
```dockerfile
FROM php:8.3-fpm

# Paquetes: git, curl, zip, nginx, supervisor, default-mysql-client
# PHP extensions: pdo_mysql, mysqli, mbstring, exif, pcntl, bcmath, gd, zip, opcache

# OPcache (producción)
opcache.enable=1
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=10000
opcache.revalidate_freq=60
opcache.validate_timestamps=0

# Limits
upload_max_filesize=20M
post_max_size=25M
memory_limit=256M
expose_php=Off

# Frontend build: Node.js 20.x → npm ci && npm run build → rm node_modules
# EXPOSE 80
```

#### Entrypoint (`docker/entrypoint.sh`)
Secuencia de inicialización del contenedor:
1. **MySQL health check**: `mysqladmin ping` con 30 reintentos (2s intervalo), fallback graceful
2. **Migraciones**: `php artisan migrate --force`
3. **Seed**: `php artisan db:seed --class=ContentSeeder --force` (solo si tablas vacías)
4. **Admin**: Crea usuario admin si `$ADMIN_PASSWORD` configurado y no existen usuarios
5. **Cache**: `config:cache`, `route:cache`, `view:cache`
6. **Storage**: `storage:link`
7. **Permisos**: `chown www-data:www-data storage bootstrap/cache`
8. **Inicio**: `exec /usr/bin/supervisord`

#### Nginx (`docker/nginx.conf`)

**Compresión gzip**:
- Level 6, min 256 bytes
- Tipos: text/plain, text/css, text/javascript, application/javascript, application/json, application/xml, application/rss+xml, image/svg+xml, font/woff2

**Cache de assets estáticos**:
- 30 días, `Cache-Control: public, immutable`
- Extensiones: css, js, jpg, jpeg, png, gif, ico, svg, woff, woff2, ttf, eot, webp, avif

**Headers de seguridad**:
- `X-Frame-Options: SAMEORIGIN`
- `X-Content-Type-Options: nosniff`
- `X-XSS-Protection: 1; mode=block`
- `Referrer-Policy: strict-origin-when-cross-origin`
- `Permissions-Policy: camera=(), microphone=(), geolocation=()`
- Oculta `X-Powered-By`

**Protección de archivos**:
- Deniega acceso a: `.env`, `.git`, `composer.json`, `composer.lock`, `package.json`, `webpack.mix.js`, `phpunit.xml`
- Deniega archivos ocultos (excepto `.well-known`)
- `client_max_body_size 20M`

**FastCGI**:
- Backend: `127.0.0.1:9000`
- Buffers: `16 16k`

---

### Variables de Entorno (Producción)

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://gpovanguardia.com.mx

DB_CONNECTION=mysql
DB_HOST=<IP servidor MySQL separado>
DB_PORT=3306
DB_DATABASE=gpo_vanguardia
DB_USERNAME=gpo_vanguardia
DB_PASSWORD=<contraseña segura>

ADMIN_EMAIL=admin@gpovanguardia.com
ADMIN_PASSWORD=<contraseña segura>
```

> **Nota**: La base de datos está en un servidor MySQL separado por seguridad (no en el mismo servidor de la app).

---

### Sistema de Webhooks (n8n / Automatización)

#### Concepto
Cada formulario público y algunos eventos admin tienen un webhook configurable que envía un POST JSON a una URL externa (ej. n8n) cuando ocurre el evento. Cada webhook se puede habilitar/deshabilitar independientemente desde el panel admin.

#### Eventos disponibles

| Evento | Disparo | Datos enviados |
|---|---|---|
| `contacto` | Formulario de contacto (`POST /contacto`) | id, nombre, email, telefono, empresa, mensaje |
| `bolsa` | Aplicación de empleo (`POST /bolsa-de-empleo`) | id, nombre, apellido, email, telefono, cv_url |
| `post_creado` | Nuevo post publicado (admin) | titulo, slug, extracto, categoria, url |

#### Modelo `Webhook`
- Tabla: `webhooks` — nombre, evento (unique), url, activo, secret, ultimo_envio, ultimo_estado, ultimo_error
- `Webhook::dispatch($evento, $data)` — envía POST JSON en segundo plano (`afterResponse()`)
- Firma HMAC-SHA256 opcional (header `X-Webhook-Signature`) si se configura un secret
- Headers: `Content-Type: application/json`, `X-Webhook-Event`, `User-Agent: GPOVanguardia-Webhook/1.0`

#### Panel Admin (`/admin/webhooks`)
- Auto-crea registros para cada evento al primer acceso
- Card por evento: URL input, secret input, switch activo/inactivo, botón guardar
- Indicador de último envío (fecha, estado OK/Error, mensaje de error)
- Botón "Test" para enviar payload de prueba
- Documentación del payload integrada en la misma página

#### Estructura del Payload
```json
{
  "evento": "contacto",
  "timestamp": "2026-02-18T12:00:00-06:00",
  "data": {
    "nombre": "Juan Pérez",
    "email": "juan@ejemplo.com",
    ...campos específicos del evento
  }
}
```

#### Integración con n8n
1. En n8n, crear nodo **Webhook** → copiar URL de producción
2. En admin `/admin/webhooks` → pegar URL en el evento deseado
3. (Opcional) Configurar un secret para firmar payloads
4. Activar el switch
5. Usar botón "Test" para verificar la conexión

---

### Login Personalizado

La página de login (`/login`) tiene branding completo de GPO Vanguardia:
- Fondo gradiente indigo (#1E1B4B → #4338CA) con efectos radiales
- Card glassmorphism (blur + transparencia)
- Logo blanco + título "Panel de Administración"
- Formulario en español, tipografía Montserrat
- Sin dependencia de Tailwind/Vite (CSS standalone)
- `noindex, nofollow` para evitar indexación
- Archivos: `layouts/guest.blade.php`, `auth/login.blade.php`