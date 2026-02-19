<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $posts = Post::publicados()->get();

        $staticPages = [
            ['url' => route('home'), 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['url' => route('servicios'), 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['url' => route('call-center'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('chatbots'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('mesa-servicios'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('cctv'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('clientes'), 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => route('contacto'), 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => route('blog.index'), 'priority' => '0.8', 'changefreq' => 'daily'],
            ['url' => route('bolsa'), 'priority' => '0.6', 'changefreq' => 'monthly'],
        ];

        $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($staticPages as $page) {
            $content .= '  <url>' . "\n";
            $content .= '    <loc>' . htmlspecialchars($page['url']) . '</loc>' . "\n";
            $content .= '    <changefreq>' . $page['changefreq'] . '</changefreq>' . "\n";
            $content .= '    <priority>' . $page['priority'] . '</priority>' . "\n";
            $content .= '  </url>' . "\n";
        }

        foreach ($posts as $post) {
            $content .= '  <url>' . "\n";
            $content .= '    <loc>' . htmlspecialchars(route('blog.show', $post)) . '</loc>' . "\n";
            $content .= '    <lastmod>' . $post->updated_at->toW3cString() . '</lastmod>' . "\n";
            $content .= '    <changefreq>weekly</changefreq>' . "\n";
            $content .= '    <priority>0.7</priority>' . "\n";
            $content .= '  </url>' . "\n";
        }

        $content .= '</urlset>';

        return response($content, 200)
            ->header('Content-Type', 'application/xml');
    }
}
