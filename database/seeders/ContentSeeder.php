<?php

namespace Database\Seeders;

use App\Models\Servicio;
use App\Models\Testimonio;
use App\Models\ValorCorporativo;
use App\Models\RedSocial;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // Servicios
        Servicio::create([
            'nombre' => 'Inteligencia Artificial y PNL',
            'slug' => 'inteligencia-artificial-pnl',
            'descripcion' => 'Gestionamos su negocio con tecnología de punta. Implementamos Chatbots inteligentes con Procesamiento de Lenguaje Natural (PNL) que aprenden y resuelven necesidades de sus clientes de forma empática y natural, garantizando disponibilidad 24/7 y una reducción significativa en costos operativos.',
            'icono' => 'fas fa-brain',
            'activo' => true,
            'orden' => 1,
        ]);
        Servicio::create([
            'nombre' => 'Ciberseguridad',
            'slug' => 'ciberseguridad',
            'descripcion' => 'Protección avanzada para su infraestructura digital. Somos especialistas en investigación de ciberseguridad, enfocados en la detección y contención de amenazas complejas mediante análisis de vulnerabilidades continuas.',
            'icono' => 'fas fa-shield-alt',
            'activo' => true,
            'orden' => 2,
        ]);
        Servicio::create([
            'nombre' => 'Business Process Outsourcing (BPO)',
            'slug' => 'business-process-outsourcing',
            'descripcion' => 'Optimización de procesos mediante la subcontratación estratégica de funciones de negocio, permitiendo a su empresa enfocarse en su núcleo operativo mientras nosotros gestionamos la eficiencia y calidad del servicio.',
            'icono' => 'fas fa-cogs',
            'activo' => true,
            'orden' => 3,
        ]);

        // Valores Corporativos
        ValorCorporativo::create([
            'nombre' => 'Excelencia',
            'descripcion' => 'Superando expectativas',
            'icono' => 'fas fa-trophy',
            'activo' => true,
            'orden' => 1,
        ]);
        ValorCorporativo::create([
            'nombre' => 'Integridad',
            'descripcion' => 'Actuamos con ética y transparencia',
            'icono' => 'fas fa-heart',
            'activo' => true,
            'orden' => 2,
        ]);
        ValorCorporativo::create([
            'nombre' => 'Innovación',
            'descripcion' => 'Vanguardia tecnológica constante',
            'icono' => 'fas fa-lightbulb',
            'activo' => true,
            'orden' => 3,
        ]);
        ValorCorporativo::create([
            'nombre' => 'Compromiso',
            'descripcion' => 'Responsabilidad con el cliente y el entorno',
            'icono' => 'fas fa-handshake',
            'activo' => true,
            'orden' => 4,
        ]);

        // Redes Sociales
        RedSocial::create([
            'nombre' => 'Facebook',
            'icono' => 'fab fa-facebook-f',
            'url' => 'https://facebook.com/gpovanguardia',
            'activo' => true,
            'orden' => 1,
        ]);
        RedSocial::create([
            'nombre' => 'LinkedIn',
            'icono' => 'fab fa-linkedin-in',
            'url' => 'https://linkedin.com/company/gpovanguardia',
            'activo' => true,
            'orden' => 2,
        ]);
        RedSocial::create([
            'nombre' => 'Instagram',
            'icono' => 'fab fa-instagram',
            'url' => 'https://instagram.com/gpovanguardia',
            'activo' => true,
            'orden' => 3,
        ]);

        // Testimonios de ejemplo
        Testimonio::create([
            'nombre' => 'Carlos Mendoza',
            'cargo' => 'Director de TI',
            'empresa' => 'Grupo Financiero Plus',
            'texto' => 'La implementación de chatbots con IA de Grupo Vanguardia transformó nuestra atención al cliente. Redujimos tiempos de respuesta en un 70%.',
            'estrellas' => 5,
            'activo' => true,
            'orden' => 1,
        ]);
        Testimonio::create([
            'nombre' => 'María López',
            'cargo' => 'CEO',
            'empresa' => 'TechSolutions MX',
            'texto' => 'Su equipo de ciberseguridad detectó vulnerabilidades críticas que otros proveedores pasaron por alto. Profesionales de primer nivel.',
            'estrellas' => 5,
            'activo' => true,
            'orden' => 2,
        ]);
        Testimonio::create([
            'nombre' => 'Roberto García',
            'cargo' => 'Gerente de Operaciones',
            'empresa' => 'Distribuidora Nacional',
            'texto' => 'El servicio de BPO nos permitió reducir costos operativos en un 40% mientras mejoramos la calidad de nuestros procesos internos.',
            'estrellas' => 5,
            'activo' => true,
            'orden' => 3,
        ]);
    }
}
