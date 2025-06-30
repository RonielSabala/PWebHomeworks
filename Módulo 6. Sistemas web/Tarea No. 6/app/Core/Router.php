<?php

namespace App\Core;

class Router
{
    public function dispatch()
    {
        global $pdo;

        # Obtener la URI
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $uri = parse_url($uri, PHP_URL_PATH);

        // Redirigir a los controladores
        if ($uri === '' || $uri === 'home.php' || $uri === 'index.php') {
            $page = 'home';
            $controller = new \App\Controllers\HomeController();
        } elseif ($uri === 'about.php') {
            $page = 'about';
            $controller = new \App\Controllers\AboutController();
        } elseif ($uri === 'edit.php') {
            $page = 'home';
            $controller = new \App\Controllers\EditController();
        } elseif ($uri === 'delete.php') {
            $page = 'home';
            $controller = new \App\Controllers\DeleteController();
        } elseif ($uri === 'pdf.php') {
            $page = 'home';
            $controller = new \App\Controllers\PdfController();
        } else {
            header("HTTP/1.0 404 Not Found");
            exit("Página no encontrada");
        }

        // Definir la página actual y manejar la solicitud
        define('CURRENT_PAGE', $page);
        $template = new Template();
        $controller->handle($template, $pdo);
    }
}
