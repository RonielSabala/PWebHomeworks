<?php

namespace App\Core;


class Router
{
    public function dispatch()
    {
        global $pdo;

        // Arrancar sesión si no está activa
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Cerramos la sesión y vamos al login
        if (!empty($_GET['logout'])) {
            // Limpiar session
            $_SESSION = [];
            if (ini_get('session.use_cookies')) {
                $params = session_get_cookie_params();
                setcookie(
                    session_name(),
                    '',
                    time() - 42000,
                    $params['path'],
                    $params['domain'],
                    $params['secure'],
                    $params['httponly']
                );
            }

            session_destroy();
            header('Location: /login.php');
            exit;
        }

        $loggedIn = !empty($_SESSION['user']);

        // Obtener URI
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        // Rutas y controladores asociados
        $default_uri = ['page' => 'home',  'controller' => \App\Controllers\HomeController::class];
        $routes = [
            ''            => $default_uri,
            'home.php'    => $default_uri,
            'index.php'   => $default_uri,
            'details.php' => ['page' => 'home',   'controller' => \App\Controllers\DetailsController::class],
            'edit.php'    => ['page' => 'home',   'controller' => \App\Controllers\EditController::class],
            'delete.php'  => ['page' => 'home',   'controller' => \App\Controllers\DeleteController::class],
            'pdf.php'     => ['page' => 'home',   'controller' => \App\Controllers\PdfController::class],
            'report.php'  => ['page' => 'report', 'controller' => \App\Controllers\ReportController::class],
            'login.php'   => ['page' => 'login',  'controller' => \App\Controllers\LoginController::class],
        ];

        // Obtener ruta
        if (isset($routes[$uri])) {
            if (!$loggedIn && $uri !== 'login.php') {
                $uri = "login.php";
            } elseif ($loggedIn && $uri === 'login.php') {
                $uri = "home.php";
            }

            $page = $routes[$uri]['page'];
            $controller = new $routes[$uri]['controller']();
        } else {
            header("HTTP/1.0 404 Not Found");
            exit("Página no encontrada...");
        }

        define('CURRENT_PAGE', $page);
        if ($page === "login") {
            Template::$showNav = false;
        }

        // Manejar solicitud
        $template = new Template();
        $controller->handle($template, $pdo);
    }
}
