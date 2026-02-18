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
- **URL**: http://127.0.0.1:8001/admin
- **Email**: admin@gpovanguardia.com
- **Password**: Vanguardia2025!

> Para crear el usuario admin en local, ejecutar:
> ```bash
> php artisan tinker --execute="App\Models\User::create(['name'=>'Admin','email'=>'admin@gpovanguardia.com','password'=>bcrypt('Vanguardia2025!')])"
> ```

---

## Estructura del Proyecto

```
gpo-vanguardia/
├── app/
│   ├── Models/                    → Servicio, Post, GaleriaImagen, Testimonio,
│   │                                RedSocial, Contact, ValorCorporativo
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
├── resources/views/
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
│   ├── admin/                     → Panel admin (layouts + CRUD views)
│   └── blog/                      → Blog index + show
├── routes/web.php                 → Todas las rutas
├── database/
│   ├── migrations/                → Tablas: servicios, posts, galeria_imagenes,
│   │                                testimonios, redes_sociales, contacts, valores_corporativos
│   └── seeders/ContentSeeder.php  → Datos iniciales
├── docker/                        → Dockerfile, nginx.conf, supervisord.conf, entrypoint.sh
├── public/images/                 → Logos, casos, imágenes estáticas
├── MEMORY.md                      → Memoria del proyecto (historial de sesiones)
└── instructions.md                → Este archivo
```

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
| `/terminos-y-condiciones` | terminos.blade.php | Términos legales (8 artículos) |
| `/aviso-de-privacidad` | aviso.blade.php | Aviso de Privacidad Integral (15 secciones) |
| `/blog` | blog/index.blade.php | Listado de artículos |
| `/blog/{slug}` | blog/show.blade.php | Artículo individual |

### Admin (requiere autenticación, prefijo `/admin`)

| Ruta | Descripción |
|---|---|
| `GET /admin` | Dashboard |
| `/admin/servicios` | CRUD Servicios |
| `/admin/posts` | CRUD Blog Posts |
| `/admin/galeria` | CRUD Galería de Imágenes |
| `/admin/testimonios` | CRUD Testimonios |
| `/admin/valores` | CRUD Valores Corporativos |
| `/admin/redes-sociales` | CRUD Redes Sociales |
| `/admin/contactos` | Ver contactos recibidos |
| `PATCH /admin/contactos/{id}/leido` | Marcar contacto como leído |
| `DELETE /admin/contactos/{id}` | Eliminar contacto |

### Contacto (POST)
- `POST /contacto` → `ContactController@store` (AJAX, throttle: 5 peticiones/minuto)

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
| ValorCorporativo | valores_corporativos | titulo, descripcion, icono, orden |
