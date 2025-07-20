<?php

namespace App\Core;


class Template
{
    /** 
     * Controla si se incluye o no la partial de navegación 
     * @var bool
     */
    public static $showNav = true;

    public function apply(string $viewName, array $data = [])
    {
        echo '
        <link rel="stylesheet" href="/css/pages/' . $viewName . '.css">
        ';

        extract($data, EXTR_SKIP);
        include __DIR__ . '/../Views/' . $viewName . '.php';
    }

    public function __construct()
    {
        $partials = __DIR__ . '/../Views/Partials/';
        include $partials . '_header.php';

        // Sólo incluimos la navegación si la bandera está en true
        if (self::$showNav) {
            include $partials . '_nav.php';
        }
    }

    public function __destruct()
    {
        include __DIR__ . '/../Views/Partials/_footer.php';
    }
}
