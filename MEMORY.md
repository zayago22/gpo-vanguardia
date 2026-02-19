# GPO Vanguardia — Project Memory

## Overview
Corporate website for **Grupo Vanguardia** — a company specializing in BPO, AI/NLP, and cybersecurity solutions. Built with Laravel 12 + Blade + Bootstrap 5.3.

## Tech Stack
- **Backend**: Laravel 12.52.0, PHP 8.3
- **Frontend**: Blade templates, Bootstrap 5.3 CDN, Font Awesome 6.4
- **DB**: MySQL (servidor separado por seguridad)
- **Auth**: Laravel Breeze (Blade stack), registration disabled
- **Deploy**: Docker → Coolify v4 (Traefik proxy)


## Project Structure
```
app/Models/       → Servicio, Post, GaleriaImagen, Testimonio, RedSocial, Contact, ValorCorporativo, JobApplication, Webhook
app/Http/Controllers/Admin/ → DashboardController, ServicioController, PostController, GaleriaController,
                               TestimonioController, RedSocialController, ContactoAdminController, ValorController, WebhookController
app/Http/Controllers/       → HomeController, ContactController, BlogController, JobApplicationController, SitemapController
resources/views/home.blade.php → Main landing page (all-in-one sections)
resources/views/admin/      → Admin panel (layouts/app.blade.php + CRUD views)
  ├── posts/ (CRUD Blog)
  ├── testimonios/ (CRUD Testimonios)
  ├── contactos/ (ver y gestionar mensajes)
  ├── redes/ (CRUD Redes Sociales)
  ├── webhooks/ (Configuración webhooks n8n)
resources/views/blog/       → Blog index + show pages
docker/                     → Dockerfile, nginx.conf, supervisord.conf, entrypoint.sh
```

## Routes
### Public
- `GET /` → HomeController@index (landing page)
- `POST /contacto` → ContactController@store (AJAX, throttle:5,1)
- `GET /blog` → BlogController@index
- `GET /blog/{post:slug}` → BlogController@show
- `GET /sitemap.xml` → SitemapController@index


### Admin (auth required, prefix configurable via ADMIN_PREFIX en .env)
- Prefijo por defecto: `gpo-panel-v25` (cambiar en producción)
- `GET /{prefix}` → Dashboard
- `/{prefix}/servicios` → CRUD Servicios
- `/{prefix}/posts` → CRUD Blog Posts
- `/{prefix}/galeria` → CRUD Galería de Imágenes
- `/{prefix}/testimonios` → CRUD Testimonios
- `/{prefix}/valores` → CRUD Valores Corporativos
- `/{prefix}/redes-sociales` → CRUD Redes Sociales
- `/{prefix}/contactos` → Ver y gestionar mensajes de contacto
- `PATCH /{prefix}/contactos/{id}/leido` → Marcar contacto como leído
- `DELETE /{prefix}/contactos/{id}` → Eliminar contacto
- `GET /{prefix}/webhooks` → WebhookController@index (config webhooks)
- `PUT /{prefix}/webhooks/{id}` → WebhookController@update
- `GET /{prefix}/webhooks/{id}/test` → WebhookController@test
- `ANY /admin*` → Honeypot (devuelve 404 para bots/scanners)

## Design
- **Colors**: Gradient #4338CA → #6366F1 (indigo/purple)
- **Font**: Inter (Google Fonts)
- **Sections**: Hero → El Propósito (Misión/Visión) → Servicios Especializados → Valores Corporativos → Testimonios → Contacto (form + map) → Footer

## Company Info
- **Teléfono**: 55 8526 3542
- **Email**: soporte@cgpvc.com
- **Dirección**: Calzada de Tlalpan 609, CDMX

## Credentials (local dev)
- **Admin**: admin@gpovanguardia.com / Vanguardia2025!
  (Acceso: http://127.0.0.1:8001/gpo-panel-v25)
  ⚠️ La URL del panel NO es /admin (honeypot 404). Configurar ADMIN_PREFIX en .env.


## Deployment (Coolify)
1. Create MySQL service on separate server (security: DB isolated from app)
2. Create new Laravel resource pointing to Git repo
3. Set environment variables:
  - DB_CONNECTION=mysql
  - DB_HOST=(IP or hostname of separate MySQL server)
  - DB_PORT=3306
  - DB_DATABASE=gpo_vanguardia
  - DB_USERNAME=gpo_vanguardia
  - DB_PASSWORD=(secure password)
  - APP_URL=https://your-domain.com
  - ADMIN_EMAIL=admin@gpovanguardia.com
  - ADMIN_PASSWORD=(set a strong password)
4. Set domain in Coolify
5. Deploy — entrypoint.sh handles migrations, seeding, admin creation, caching
6. Admin CRUD disponible en `/{ADMIN_PREFIX}` (configurar en .env, NO usar /admin)

## Instrucciones de Acceso Rápido

### Desarrollo Local
1. Iniciar servidor: `php artisan serve --port=8001`
2. Web pública: http://127.0.0.1:8001
3. Panel admin: http://127.0.0.1:8001/gpo-panel-v25
4. Login: admin@gpovanguardia.com / Vanguardia2025!

### Producción
1. Web pública: https://tu-dominio.com
2. Panel admin: https://tu-dominio.com/{ADMIN_PREFIX}
3. Cambiar `ADMIN_PREFIX` en `.env` a algo único para el servidor
4. Cambiar la contraseña del admin inmediatamente después del primer deploy

### Seguridad del Panel
- `/admin` y `/admin/*` devuelven 404 (honeypot para bots)
- Login tiene rate limit: 5 intentos/minuto por IP
- El prefijo del panel es configurable via `ADMIN_PREFIX` en `.env`
- Registro de usuarios deshabilitado (solo se crea admin via seeder/tinker)
- Contraseña usa bcrypt con 12 rounds

## Design System (Figma-matched)
- **Primary Color**: `--primary: #4338CA` (indigo)
- **Gradient**: `#4338CA → #6366F1`
- **Fonts**: Montserrat (all weights 300-900, italic) used throughout:
  - Body: Montserrat 400/500 (regular text)
  - Headings: Montserrat 700/800 (section titles, hero h1, servicio h3)
  - Nav/UI: Montserrat 500/600
- **Section Titles**: Playfair Display italic + `::after` blue underline (60px wide, 3px)
- **Navbar**: White bg, `border-bottom: 3px solid var(--primary)`, dark text links
- **Hero**: Building photo bg (Unsplash), blue overlay `rgba(55,48,163,0.82)`, Playfair Display italic h1, white wave curve `::after`
- **El Propósito**: Gray bg, serif title with blue underline, icon squares in cards, 50/50 layout with taller image
- **Casos de Éxito**: 3x2 CSS grid, white rounded cards, 6 client logos in `public/images/casos/`
- **Servicios**: 50/50 flex layout, alternating image/text, solid blue icon (58px), image height 360px, Playfair h3 28px, responsive stacking at 991px

## Sessions Log

### Session 1 (Initial Build) — Commit `a8f2f82`
- Created Laravel 12 project with Breeze (Blade)
- Built 7 models with migrations (servicios, posts, galeria_imagenes, testimonios, redes_sociales, contacts, valores_corporativos)
- Created 11 controllers (3 public + 8 admin)
- Created ContentSeeder with initial data
- Built home.blade.php matching Figma design
- Built full admin panel with CRUD for all resources
- Built blog pages (index + show with related posts)
- Docker deployment files (Dockerfile, nginx, supervisor, entrypoint)
- Disabled public registration
- Added trustProxies for Coolify/Traefik
- Created admin user (local dev)

### Session 2 (Header Redesign) — Commit `9536093`
- Redesigned navbar: white bg + blue bottom border, dark text links
- Redesigned hero: building photo bg + blue overlay + Playfair Display italic title + white wave curve

### Session 3 (El Propósito + Casos de Éxito) — Commit `b0523e3`, `1772e0d`
- Redesigned "El Propósito" section: serif title, blue underline, icon circles, gray bg, taller image
- Added "Casos de Éxito" section: 3x2 CSS grid with 6 client logos (Grin, Econduce, partner, Walmart, Big Cola, Gobierno de México)
- Logos stored in `public/images/casos/`

### Session 4 (Servicios Redesign) — Commit `30e6358`
- Redesigned "Servicios Especializados" to match Figma
- Icon: 48px→58px, solid blue bg (no gradient), border-radius 16px, blue box-shadow
- Image: height 280px→360px, border-radius 20px, stronger shadow
- Title: 24px→28px, Playfair Display serif font
- Description: 14px→16px, line-height 1.9
- Added responsive breakpoint at 991px
- Fixed extra `}` CSS syntax error after casos media query

### Session 5 (Font + Image Fixes) — Commits `02105d1`, `0c8dff4`
- Replaced ALL fonts from Inter + Playfair Display → **Montserrat** across all views:
  - home.blade.php (body, hero h1, section-title, servicio h3)
  - admin/layouts/app.blade.php
  - blog/index.blade.php
  - blog/show.blade.php
- Weight system: 800 for hero h1, 700 for section titles/h3, 400-500 for body, letter-spacing -0.5px on titles
- Fixed broken Unsplash placeholder images for services:
  - IA y PNL: `photo-1485827404703` (robot/technology)
  - Ciberseguridad: `photo-1550751827` (digital security circuits)
  - BPO: `photo-1552664730` (team working)
- Increased placeholder resolution from 600×300 → 800×500

### Session 6 (Complete Remaining Sections) — Commit `e311dbe`
- **Valores Corporativos**: CSS grid 4-col layout, cards with gradient top-bar on hover, 72px icons, smooth transitions
- **Testimonios**: Dedicated `.testimonio-card` with quote icon, star ratings, italic text, avatar circle with initial, author info with border-top separator
- **Contacto**: Dark bg (`--dark`) with decorative circles, 3-col info cards grid with gradient icon squares, 2-col form+map grid, form with row layout (2 fields per row), rounded 20px cards, min-height 480px map
- **Footer**: 4-column grid (about + 3 link columns), logo + brand text, social icons as rounded squares, Navegación/Servicios/Contacto columns, dark bg `#0F0D2E`
- All sections fully responsive with media queries for 991px, 575px breakpoints

### All Landing Page Sections Complete
1. ✅ Navbar (white, blue border, dropdown servicios)
2. ✅ Hero (building bg, blue overlay, wave)
3. ✅ El Propósito (gray bg, 50/50 layout)
4. ✅ Casos de Éxito (3x2 logo grid)
5. ✅ Servicios Especializados (alternating layout)
6. ✅ Valores Corporativos (4-col grid)
7. ✅ Testimonios (3-col cards)
8. ✅ Contacto (dark bg, form + map)
9. ✅ Footer (4-col, dark bg, términos link)

### Session 7 (CCTV Page + Términos) — Commits `790059c`, `0115042`
- **Navbar dropdown**: "Servicios" now a dropdown with IA/PNL, Ciberseguridad, BPO + CCTV (divider separated)
- **CCTV Page** (`/cctv` → `cctv.blade.php`):
  - Hero with security camera bg + dark overlay + wave
  - 4 CCTV services in 2x2 grid: Videovigilancia, Sensores de Alarma, Monitoreo Continuo, Analítica IA
  - Equipamiento grid (15 items, 3 cols): cámaras, servidores, monitores, backup nube, etc.
  - 5 RFID sections alternating layout: Control Herramientas, Inventario Activos, Control Armas, Acceso Eventos, Acceso Vehicular
  - CTA section + full footer
- **Términos y Condiciones** (`/terminos-y-condiciones` → `terminos.blade.php`):
  - Gradient header + legal card with 8 numbered articles
  - Content from original gpovanguardia.com.mx/terminos-y-condiciones/
  - Styled with numbered badges, left-border intro, Montserrat typography
- **Footer updated** on all 3 pages: "Términos y Condiciones" link added
- **Routes added**: `cctv`, `terminos` in `HomeController`

### Session 8 (URLs from gpovanguardia.com.mx) — Commit `782b6a3`
- Analizó gpovanguardia.com.mx y replicó todas las URLs/páginas faltantes
- **Nuevas páginas creadas**:
  - `/servicios` → servicios.blade.php (BPO, Desarrollo Web, Ciberseguridad, Agencia Digital)
  - `/clientes` → clientes.blade.php (casos de éxito: VBike, Econduce, Grin)
  - `/contacto` → contacto.blade.php (form AJAX + mapa + redes sociales)
  - `/call-center-omnicanal` → call-center.blade.php (contenido original del sitio)
  - `/chat-bots-y-ai` → chatbots.blade.php (contenido original del sitio)
  - `/mesa-de-servicios` → mesa-servicios.blade.php (contenido original del sitio)
  - `/aviso-de-privacidad` → aviso.blade.php
- **Navbar actualizada** en home.blade.php: dropdown con todos los servicios, Clientes, Contacto como rutas reales
- **Footer actualizado** en home.blade.php: redes sociales con links reales (Facebook: callcentergrupovanguardia, LinkedIn: gpo-vanguardia), columna Servicios con links reales
- **Redes sociales reales**: Facebook → facebook.com/callcentergrupovanguardia | LinkedIn → linkedin.com/company/gpo-vanguardia
- Todas las páginas nuevas tienen navbar + footer consistentes con diseño del proyecto

### Session 9 (Aviso de Privacidad completo) — Commits `664c68f`, `cc196e2`
- **aviso.blade.php reescrito completamente** con contenido real de gpovanguardia.com.mx/aviso-de-privacidad/
- 15 secciones numeradas con badges, mismo diseño que terminos.blade.php:
  1. Finalidad del Tratamiento de Datos (principales + secundarias)
  2. ¿Qué Datos Personales Recabamos? (identificación, académicos, laborales, económicos, fiscales, sensibles)
  3. Consentimiento
  4. Medios por los que Obtiene sus Datos (personal, directa, indirecta)
  5. Uso de Cookies y Web Beacons
  6. Medidas de Seguridad Implementadas
  7. Transferencia de Datos Personales (6 supuestos)
  8. Oposición a la Transferencia
  9. Derecho ARCO (procedimiento, requisitos, encargado, plazos, negativa)
  10. Revocación del Consentimiento
  11. Obligaciones como Encargado
  12. Vigencia de la Información
  13. Aceptación de los Términos
  14. Cambios al Aviso de Privacidad
  15. Encargado: Jeniffer Haide López Romero (comentarios@ccgvic.com)
- Botón de descarga formato ARCO (GV-FOR-GDP-007)
- Actualización: 30 de mayo de 2025
- **Fix encoding UTF-8**: archivo reconstruido desde cero por corrupción de caracteres (PowerShell heredoc convirtió acentos en `�` y `'` en `''`)
- Navbar y footer consistentes con todas las demás páginas

### Session 10 (Documentación + MySQL) — Commits `9920567`, `03df046`
- **instructions.md creado** — guía de referencia completa del proyecto:
  - Stack tecnológico, instalación local paso a paso, estructura del proyecto
  - Tabla de rutas públicas y admin, sistema de diseño (colores, tipografía, componentes)
  - Información de la empresa, comandos útiles (artisan, git, docker)
  - Deploy en Coolify, convenciones de código, modelos de BD
- **Base de datos cambiada a MySQL** (servidor separado por seguridad):
  - Decisión: la BD no comparte servidor con la app por seguridad
  - Actualizado en instructions.md: requisitos, instalación, deploy, advertencias
  - Actualizado en MEMORY.md: Tech Stack, Deployment
  - Local: MySQL de Laragon (`127.0.0.1:3306`, charset `utf8mb4`)
  - Producción: servidor MySQL dedicado (IP privada o hostname interno)

### ⚠️ Nota importante para futuras sesiones
- **NO usar PowerShell heredoc (`@' ... '@`)** para escribir archivos Blade con acentos/español — corrompe el encoding
- Usar siempre `create_file` del editor o herramientas nativas de VS Code para crear/editar archivos con caracteres UTF-8

### Pages Summary (Updated)
| Route | View | Description |
|-------|------|-------------|
| `/` | home.blade.php | Landing page (all sections) |
| `/servicios` | servicios.blade.php | Página de todos los servicios |
| `/clientes` | clientes.blade.php | Casos de éxito |
| `/contacto` | contacto.blade.php | Página de contacto con form + mapa |
| `/call-center-omnicanal` | call-center.blade.php | Call Center Omnicanal |
| `/chat-bots-y-ai` | chatbots.blade.php | Chat Bots y AI |
| `/mesa-de-servicios` | mesa-servicios.blade.php | Mesa de Servicios |
| `/cctv` | cctv.blade.php | CCTV + RFID services |
| `/terminos-y-condiciones` | terminos.blade.php | Legal terms |
| `/aviso-de-privacidad` | aviso.blade.php | Aviso de Privacidad Integral (15 secciones, contenido real de gpovanguardia.com.mx) |
| `/blog` | blog/index.blade.php | Blog listing |
| `/blog/{slug}` | blog/show.blade.php | Blog post |
| `/admin` | admin/ | Admin panel (CRUD) |


### Session 11 (Implementación SEO centralizada) — Commit `seo-centralizado`
- Se implementó configuración SEO centralizada en `config/seo.php` con meta tags por defecto y por página.
- Se creó el helper `app/Helpers/SeoHelper.php` para obtener meta tags y datos de empresa desde cualquier controlador o vista.
- Se añadieron componentes Blade en `resources/views/components/seo/` para meta tags (`meta-tags.blade.php`) y schema.org (`schema-organization.blade.php`, `schema-local-business.blade.php`).
- Se integró la inclusión automática de meta tags y schema en el `<head>` de `layouts/app.blade.php`.
- Ahora es posible personalizar meta tags dinámicamente por página usando `$page` y `$meta` desde los controladores o vistas.

### Session 12 (Fix Blog Layout + SEO Components) — [2026-02-18]

#### Problemas resueltos:
1. **Bug SEO schema-organization.blade.php**: Error `unexpected end of file` por acceso a arrays anidados null.
   - Solución: Cambiar `$company['address']['street'] ?? ''` por `data_get($company, 'address.street', '')`
   - Aplicado a `schema-organization.blade.php` y `schema-local-business.blade.php`

2. **Bug blog/index.blade.php y blog/show.blade.php**: Faltaba `</style>` antes de las secciones HTML.
   - Causa: CSS inline no cerrado correctamente.

3. **Bug Layout incompatible**: El blog usaba `layouts/app.blade.php` (Breeze/admin) que incluye componentes SEO y navigation de admin.
   - Solución: Crear nuevo layout `layouts/public.blade.php` específico para páginas públicas.

#### Cambios realizados:
- **Nuevo archivo**: `resources/views/layouts/public.blade.php`
  - Navbar público con logo, menú de navegación, dropdown de servicios
  - Footer completo con 4 columnas: About, Navegación, Servicios, Contacto
  - Redes sociales, copyright, links legales
  - Efecto scroll en navbar
  - NO incluye componentes SEO de Breeze

- **Actualizados**: `blog/index.blade.php` y `blog/show.blade.php`
  - Cambiado de `@extends('layouts.app')` → `@extends('layouts.public')`
  - Removido footer duplicado (ahora viene del layout)
  - Limpiados estilos CSS innecesarios (.navbar-blog, .footer-blog)
  - Agregado `margin-top: 70px` a hero para compensar navbar fixed

#### Arquitectura de Layouts:
| Layout | Uso | Incluye |
|--------|-----|--------|
| `layouts/app.blade.php` | Admin panel (Breeze) | Navigation admin, SEO components, @vite |
| `layouts/public.blade.php` | Blog público | Navbar público, Footer completo, Bootstrap CDN |
| Páginas públicas (home, servicios, etc.) | Landing pages | Todo inline (no usan layout) |

#### ⚠️ REGLA IMPORTANTE:
- **NUNCA** usar `layouts/app.blade.php` para páginas públicas
- Las páginas del blog DEBEN usar `layouts/public.blade.php`
- Las páginas de servicio (home, servicios, cctv, etc.) son standalone con todo inline

### Session 13 (Blog Fixes: Publicación + Imágenes clickeables) — [2026-02-18]

#### Problemas resueltos:
1. **Posts no se mostraban en frontend**: El checkbox "Publicado" en el form de admin (`admin/posts/form.blade.php`) tenía default `false`, así que los posts nuevos se creaban como no publicados aunque el admin pensara que sí.
   - **Fix**: Cambié el default del checkbox de `false` → `true` para que al crear un post nuevo ya salga publicado.
   - Corregido el post "prueba2" en BD (estaba con `publicado=NO`).

2. **Imágenes del blog no eran clickeables**: Las imágenes de los posts en el home, blog/index y artículos relacionados no llevaban al artículo al hacer click.
   - **Fix**: Envueltas las imágenes/placeholders en `<a href>` en 3 archivos:
     - `home.blade.php` — sección Blog del landing
     - `blog/index.blade.php` — listado de posts
     - `blog/show.blade.php` — artículos relacionados

#### Archivos modificados:
- `resources/views/admin/posts/form.blade.php` — checkbox publicado default=true
- `resources/views/home.blade.php` — post-card-img → `<a>` clickeable
- `resources/views/blog/index.blade.php` — post-card-img → `<a>` clickeable
- `resources/views/blog/show.blade.php` — related-card-img → `<a>` clickeable

### Session 14 (Blog: filtros por categoría, búsqueda y fecha) — [2026-02-18]
- Nuevo campo **categoría** para posts (migration + fillable) y campo en el formulario de admin (`admin/posts/form.blade.php`).
- Filtros en `/blog`: categoría, buscador (título/extracto/contenido) y rango de fechas (desde/hasta).
- Controlador `BlogController@index` ahora acepta filtros y mantiene query strings en la paginación.
- Vista `blog/index.blade.php` incluye tarjeta de filtros con select de categorías disponibles.
- **Migraciones aplicadas**: `php artisan migrate` ejecutado (agrega columna `categoria`).

### Session 15 (Bolsa de empleo con formulario y CV) — [2026-02-18]
- Página dedicada **bolsa.blade.php** (no aparece en navbar, solo enlace en footer) con formulario: nombre, apellido, correo, teléfono y carga de CV (PDF/DOC/DOCX, 5 MB), badge y estilos propios.
- Ruta: `GET /bolsa-de-empleo` (vista) y `POST /bolsa-de-empleo` → `JobApplicationController@store` (usa bolsa error bag). Guarda en tabla `job_applications` y sube CV a `storage/app/public/job_applications`.
- Navbar vuelve a la versión sin “Bolsa”; el footer (home y layout público) incluye link a la página de bolsa.
- Nuevos archivos: `JobApplication` (modelo), `JobApplicationController`, `resources/views/bolsa.blade.php`, migración `2026_02_18_000002_create_job_applications_table.php`.

### Session 16 (Fix: Restaurar home.blade.php roto) — [2026-02-18]

#### Problema:
- La página principal quedó **rota** tras las ediciones de sesiones anteriores: al eliminar HTML sobrante se borraron accidentalmente las secciones **Casos de Éxito** y **Servicios Especializados**. Además, el `<head>` perdió las meta tags, CSS variables, enlaces a fuentes/Bootstrap y estilos del navbar.

#### Solución:
1. Se restauró `home.blade.php` desde el último commit limpio (`git checkout 212e1a8 -- resources/views/home.blade.php`).
2. Se reaplicaron los 4 cambios deseados sobre la versión restaurada:
   - **Blog cards CSS** (`.post-card`, `.post-card-img`, `.post-card-body`, `.btn-view-all`, etc.) añadido antes de `</style>`.
   - **Imágenes clickeables** en la sección Blog del home (envueltas en `<a href>`).
   - **Estilo mejorado** del blog: card con aspect-ratio 1:1, placeholder con gradiente, meta con icono, título/extracto con clases, botón "Ver todos" con gradiente.
   - **Link "Bolsa de empleo"** en footer → `{{ route('bolsa') }}`.
3. Se ejecutó la migración pendiente `create_job_applications_table`.
4. Se verificó que `storage:link` ya existía.

#### Estado final:
- Home renderiza correctamente todas las secciones: Navbar → Hero → El Propósito → Casos de Éxito → Servicios Especializados → Valores → Testimonios → Blog → Contacto → Footer.
- Bolsa de empleo funciona como página dedicada con formulario.
- Blog con imágenes clickeables y filtros operativos.
### Session 17 (SEO completo + Preparación VPS) — [2026-02-18]

#### Objetivo:
Slugs editables en blog, optimización SEO integral y preparación de Docker/Nginx para migración a VPS.

#### 1. Blog Slug editable + meta_description
- **Post model**: Añadido `getRouteKeyName()` → `'slug'`, método estático `generateUniqueSlug($title, $excludeId)` con sufijo numérico para duplicados, `meta_description` en `$fillable`.
- **Admin PostController**: `store()` y `update()` aceptan `slug` (nullable, alpha_dash) y `meta_description` (nullable, max:160). Si no se envía slug se genera automáticamente del título.
- **Admin form (`admin/posts/form.blade.php`)**: Campo slug editable con prefijo `/blog/`, textarea meta_description con contador de 160 caracteres, JS auto-generación de slug desde título.
- **Migración**: `2026_02_18_100000_add_meta_description_to_posts_table.php` — agrega columna `meta_description` varchar(160) nullable.

#### 2. SEO — Configuración centralizada (`config/seo.php`)
- Corregidos links sociales reales: Facebook (`callcentergrupovanguardia`), LinkedIn (`gpo-vanguardia`), Instagram (`gpovanguardia`). Twitter eliminado.
- Añadida configuración de páginas: `chatbots`, `mesa-servicios`, `bolsa`, `blog`, `terminos` (noindex), `aviso` (noindex).

#### 3. SEO — Meta tags y componentes
- **`components/seo/meta-tags.blade.php`**: Añadido canonical URL, og:site_name, og:locale (es_MX), Twitter Card tags, variable `$siteUrl` para URLs absolutas de imágenes.
- **`partials/seo-head.blade.php`** (NUEVO): Partial para páginas standalone — incluye OG, Twitter Card, canonical, JSON-LD Organization + LocalBusiness. Usa `SeoHelper` para datos de empresa.
- **Bug crítico `@context`/`@type`**: En Laravel 12, Blade interpreta `@context` como directiva (error "unexpected end of file"). Solución: escapar con `@@context`, `@@type`, `@@id` en todos los JSON-LD.
  - Aplicado en: `partials/seo-head.blade.php`, `schema-organization.blade.php`, `schema-local-business.blade.php`, `blog/index.blade.php`, `blog/show.blade.php`.

#### 4. SEO — Todas las páginas standalone actualizadas
Cada página incluye `@include('partials.seo-head', ['seoPage' => '...'])`:
- `home.blade.php`, `servicios.blade.php`, `clientes.blade.php`, `contacto.blade.php`
- `call-center.blade.php`, `chatbots.blade.php`, `mesa-servicios.blade.php`, `cctv.blade.php`
- `terminos.blade.php`, `aviso.blade.php`
- Algunas páginas ya tenían meta description/keywords inline que se mantuvieron como fallback.

#### 5. SEO — Blog con schema.org
- **`blog/show.blade.php`**: Schema.org `BlogPosting` (author, datePublished, dateModified, description, image) + `BreadcrumbList`. Section `description` usa `meta_description` o `extracto` como fallback. Section `og_type` = `article`.
- **`blog/index.blade.php`**: `BreadcrumbList` schema.org. Description desde config.
- **`layouts/public.blade.php`**: Añadido favicon, canonical, robots meta, author, OG completo (site_name, locale, title, description, image, type, url), Twitter Card, `@yield('seo_extra')` para schema.org por página.

#### 6. SEO — Sitemap + Robots.txt
- **`SitemapController`** (NUEVO): Genera `sitemap.xml` dinámico con 10 páginas estáticas (con prioridad/changefreq) + todos los blog posts publicados con lastmod.
- **Ruta**: `GET /sitemap.xml` → `SitemapController@index`
- **`public/robots.txt`**: Allow `/`, Disallow admin/login/register/password/profile/dashboard, Sitemap URL a `https://gpovanguardia.com.mx/sitemap.xml`.

#### 7. Docker/VPS — MySQL + Optimización
- **Dockerfile**: Cambiado de PostgreSQL a MySQL (`pdo_mysql mysqli`), removido `libpq-dev`, añadido `default-mysql-client`, extensión `opcache`, PHP production.ini (opcache, upload limits 20M, memory 256M, expose_php=Off).
- **`docker/entrypoint.sh`**: Cambiado de `db:monitor --databases=pgsql` a `mysqladmin ping` con retry (30 intentos, 2s intervalo), fallback graceful si DB no disponible.
- **`docker/nginx.conf`**: Gzip (CSS/JS/JSON/XML/SVG/fonts), cache estático 30d immutable, headers de seguridad (X-XSS-Protection, Referrer-Policy, Permissions-Policy), ocultar X-Powered-By, optimización fastcgi buffers, denegar acceso a .env/.git/composer.json.
- **`.env.example`**: Cambiado de `pgsql/5432/postgres` a `mysql/3306/gpo_vanguardia`.

#### Archivos creados:
- `resources/views/partials/seo-head.blade.php`
- `app/Http/Controllers/SitemapController.php`
- `database/migrations/2026_02_18_100000_add_meta_description_to_posts_table.php`

#### Archivos modificados:
- `app/Models/Post.php` — slug editable, meta_description
- `app/Http/Controllers/Admin/PostController.php` — slug/meta validation
- `resources/views/admin/posts/form.blade.php` — campos slug y meta_description
- `config/seo.php` — links reales, nuevas páginas
- `resources/views/components/seo/meta-tags.blade.php` — canonical, OG, Twitter
- `resources/views/components/seo/schema-organization.blade.php` — @@context fix, logo path
- `resources/views/components/seo/schema-local-business.blade.php` — @@context fix
- `resources/views/layouts/public.blade.php` — SEO completo
- `resources/views/blog/index.blade.php` — SEO schema
- `resources/views/blog/show.blade.php` — BlogPosting schema
- `resources/views/home.blade.php` — seo-head include
- `resources/views/servicios.blade.php` — seo-head include
- `resources/views/clientes.blade.php` — seo-head include
- `resources/views/contacto.blade.php` — seo-head include
- `resources/views/call-center.blade.php` — seo-head include
- `resources/views/chatbots.blade.php` — seo-head include
- `resources/views/mesa-servicios.blade.php` — seo-head include
- `resources/views/cctv.blade.php` — seo-head include
- `resources/views/terminos.blade.php` — seo-head include
- `resources/views/aviso.blade.php` — seo-head include
- `routes/web.php` — ruta sitemap.xml
- `public/robots.txt` — reglas SEO
- `Dockerfile` — MySQL + opcache
- `docker/entrypoint.sh` — MySQL health check
- `docker/nginx.conf` — gzip, cache, security
- `.env.example` — MySQL defaults

#### ⚠️ REGLA Blade + JSON-LD:
- **SIEMPRE** usar `@@context`, `@@type`, `@@id` dentro de `<script type="application/ld+json">` en archivos Blade.
- Laravel 12 interpreta `@context` como directiva Blade y causa error fatal.
- Blade renderiza `@@context` → `@context` en el HTML final (correcto para JSON-LD).

### Session 18 (Favicon, Login branding, Logo admin) — [2026-02-18]

#### Cambios realizados:
1. **Favicon personalizado**: Todas las vistas (12 archivos) cambiadas de `images/logo.png` a `images/favicon.png`. Favicon añadido también a `layouts/app.blade.php` (admin) que no lo tenía.
2. **Logo admin (Breeze)**: `components/application-logo.blade.php` — reemplazado SVG de Laravel por `<img>` con `images/logo.png` de GPO Vanguardia.
3. **Login personalizado**: Rediseño completo de `layouts/guest.blade.php` y `auth/login.blade.php`:
   - Fondo gradiente indigo (#1E1B4B → #4338CA) con efectos radiales
   - Card glassmorphism (blur + transparencia)
   - Logo blanco centrado + título "Panel de Administración"
   - Formulario en español: labels, placeholders, botón "Iniciar Sesión"
   - Tipografía Montserrat (consistente con admin)
   - Footer con copyright + link "Volver al sitio"
   - `noindex, nofollow` + favicon
   - Sin dependencia de Tailwind/Vite (standalone CSS)

#### Archivos modificados:
- `resources/views/layouts/guest.blade.php` — rediseño completo
- `resources/views/auth/login.blade.php` — formulario en español, clases custom
- `resources/views/components/application-logo.blade.php` — logo empresa
- `resources/views/layouts/app.blade.php` — añadido favicon
- 11 vistas públicas — favicon.png en lugar de logo.png

### Session 19 (Webhooks para n8n / Automatización) — [2026-02-18]

#### Objetivo:
Sistema de webhooks configurable desde admin para integrar con n8n. Cada formulario/evento tiene su webhook independiente que se puede habilitar/deshabilitar.

#### Implementación:
1. **Modelo `Webhook`** (`app/Models/Webhook.php`):
   - Campos: nombre, evento (unique), url, activo, secret, ultimo_envio, ultimo_estado, ultimo_error
   - Constante `EVENTOS`: contacto, bolsa, post_creado
   - Método `dispatch($evento, $data)`: envía POST JSON en segundo plano (`afterResponse()`), firma HMAC-SHA256 si hay secret, registra estado
   - Headers: `X-Webhook-Event`, `X-Webhook-Signature`, `User-Agent: GPOVanguardia-Webhook/1.0`

2. **Admin WebhookController** (`app/Http/Controllers/Admin/WebhookController.php`):
   - `index()`: Lista webhooks, auto-crea registros para eventos sin configurar
   - `update()`: Guarda URL, secret, switch activo (requiere URL para activar)
   - `test()`: Envía payload de prueba al webhook

3. **Vista admin** (`resources/views/admin/webhooks/index.blade.php`):
   - Card por evento con icono, nombre, código del evento
   - Input URL + input secret (opcional) + switch activo/inactivo
   - Indicador de último envío (fecha + estado OK/Error)
   - Botón "Test" para envío de prueba
   - Documentación del payload y headers en la misma página

4. **Integración en controllers**:
   - `ContactController@store` → `Webhook::dispatch('contacto', [...])` — nombre, email, telefono, empresa, mensaje
   - `JobApplicationController@store` → `Webhook::dispatch('bolsa', [...])` — nombre, apellido, email, telefono, cv_url
   - `PostController@store` → `Webhook::dispatch('post_creado', [...])` — titulo, slug, extracto, categoria, url (solo si publicado)

5. **Sidebar admin**: Link "Webhooks" con icono `fa-plug` añadido antes del separador
6. **Flash messages**: Soporte para `session('error')` añadido al layout admin

#### Archivos creados:
- `database/migrations/2026_02_18_200000_create_webhooks_table.php`
- `app/Models/Webhook.php`
- `app/Http/Controllers/Admin/WebhookController.php`
- `resources/views/admin/webhooks/index.blade.php`

#### Archivos modificados:
- `app/Http/Controllers/ContactController.php` — dispatch webhook contacto
- `app/Http/Controllers/JobApplicationController.php` — dispatch webhook bolsa
- `app/Http/Controllers/Admin/PostController.php` — dispatch webhook post_creado
- `routes/web.php` — rutas admin/webhooks (index, update, test)
- `resources/views/admin/layouts/app.blade.php` — link sidebar + flash error

#### Payload de ejemplo (contacto):
```json
{
  "evento": "contacto",
  "timestamp": "2026-02-18T12:00:00-06:00",
  "data": {
    "nombre": "Juan Pérez",
    "email": "juan@ejemplo.com",
    "telefono": "55 1234 5678",
    "empresa": "Mi Empresa",
    "mensaje": "Quisiera más información..."
  }
}
```