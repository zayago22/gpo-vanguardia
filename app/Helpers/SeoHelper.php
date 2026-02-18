<?php

namespace App\Helpers;

class SeoHelper
{
    /**
     * Obtiene los meta tags SEO para una página.
     * @param string|null $page
     * @param array $overrides
     * @return array
     */
    public static function meta($page = null, $overrides = [])
    {
        $seo = config('seo');
        $defaults = $seo['defaults'];
        $meta = $defaults;

        if ($page && isset($seo['pages'][$page])) {
            $meta = array_merge($meta, $seo['pages'][$page]);
        }
        // Permite sobreescribir desde el controlador o vista
        $meta = array_merge($meta, $overrides);
        return $meta;
    }

    /**
     * Devuelve datos de la empresa para schema.org
     * @return array
     */
    public static function company()
    {
        return config('seo.company');
    }
}
