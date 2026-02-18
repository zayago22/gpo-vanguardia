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
app/Models/       → Servicio, Post, GaleriaImagen, Testimonio, RedSocial, Contact, ValorCorporativo
app/Http/Controllers/Admin/ → DashboardController, ServicioController, PostController, GaleriaController,
                               TestimonioController, RedSocialController, ContactoAdminController, ValorController
app/Http/Controllers/       → HomeController, ContactController, BlogController
resources/views/home.blade.php → Main landing page (all-in-one sections)
resources/views/admin/      → Admin panel (layouts/app.blade.php + CRUD views)
  ├── posts/ (CRUD Blog)
  ├── testimonios/ (CRUD Testimonios)
  ├── contactos/ (ver y gestionar mensajes)
  ├── redes/ (CRUD Redes Sociales)
resources/views/blog/       → Blog index + show pages
docker/                     → Dockerfile, nginx.conf, supervisord.conf, entrypoint.sh
```

## Routes
### Public
- `GET /` → HomeController@index (landing page)
- `POST /contacto` → ContactController@store (AJAX, throttle:5,1)
- `GET /blog` → BlogController@index
- `GET /blog/{post:slug}` → BlogController@show


### Admin (auth required, prefix /admin)
- `GET /admin` → Dashboard
- `/admin/servicios` → CRUD Servicios
- `/admin/posts` → CRUD Blog Posts
- `/admin/galeria` → CRUD Galería de Imágenes
- `/admin/testimonios` → CRUD Testimonios
- `/admin/valores` → CRUD Valores Corporativos
- `/admin/redes-sociales` → CRUD Redes Sociales
- `/admin/contactos` → Ver y gestionar mensajes de contacto
- `PATCH /admin/contactos/{id}/leido` → Marcar contacto como leído
- `DELETE /admin/contactos/{id}` → Eliminar contacto

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
  (Acceso: http://127.0.0.1:8001/admin)


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
6. Admin CRUD para posts, testimonios, contactos y redes sociales disponible en `/admin`.

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
