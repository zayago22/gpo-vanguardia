# GPO Vanguardia — Project Memory

## Overview
Corporate website for **Grupo Vanguardia** — a company specializing in BPO, AI/NLP, and cybersecurity solutions. Built with Laravel 12 + Blade + Bootstrap 5.3.

## Tech Stack
- **Backend**: Laravel 12.52.0, PHP 8.3
- **Frontend**: Blade templates, Bootstrap 5.3 CDN, Font Awesome 6.4
- **DB (local)**: SQLite
- **DB (production)**: PostgreSQL (Coolify separate service)
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
- Resources: servicios, posts, galeria, testimonios, valores, redes-sociales
- `GET /admin/contactos` → List contacts
- `PATCH /admin/contactos/{id}/leido` → Mark read
- `DELETE /admin/contactos/{id}` → Delete

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

## Deployment (Coolify)
1. Create PostgreSQL service
2. Create new Laravel resource pointing to Git repo
3. Set environment variables:
   - DB_CONNECTION=pgsql
   - DB_HOST=(PostgreSQL internal hostname)
   - DB_PORT=5432
   - DB_DATABASE=gpo_vanguardia
   - DB_USERNAME=postgres
   - DB_PASSWORD=(from PostgreSQL service)
   - APP_URL=https://your-domain.com
   - ADMIN_EMAIL=admin@gpovanguardia.com
   - ADMIN_PASSWORD=(set a strong password)
4. Set domain in Coolify
5. Deploy — entrypoint.sh handles migrations, seeding, admin creation, caching

## Design System (Figma-matched)
- **Primary Color**: `--primary: #4338CA` (indigo)
- **Gradient**: `#4338CA → #6366F1`
- **Fonts**: Inter (body), Playfair Display italic (section titles, hero h1, servicio h3)
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

### Remaining Figma Sections (not yet reviewed)
- Valores Corporativos
- Testimonios
- Contacto
- Footer
