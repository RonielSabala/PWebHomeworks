<?php

$pagina_actual = "";

function updatePage()
{
    global $pagina_actual;
    $pagina_actual = defined("PAGINA_ACTUAL") ? PAGINA_ACTUAL : "";
}

function getActiveClass($targetPage)
{
    global $pagina_actual;
    return "api-link nav-link " . (($pagina_actual === $targetPage) ? 'active' : '');
}

function base_url($path = "")
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $path = trim($path, "/");
    return $protocol . $host . "/" . $path;
}

class Preset
{
    public static $instance = null;
    public static function apply(): Preset
    {
        if (self::$instance == null) {
            self::$instance = new Preset();
        }

        return self::$instance;
    }

    public function __construct()
    {
        updatePage();
    ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="/library/styles.css">
            <title>Portal web</title>
        </head>
        <body>
            <div class="container">
                <div class="text-center" style="margin-bottom: 30px;">
                    <h1 class="title">Portal Web</h1>
                    <p">Aquí podrás encontrar una serie de APIs a tu disposición.</p>
                </div>
                <div class="divMenu">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="<?= getActiveClass('inicio'); ?>" href="/">Inicio</a>
                        </li>
                        <?php
                        for ($i = 1; $i <= 10; $i++) {
                            $apiName = "Api{$i}";
                            $href = "/views/{$apiName}/main.php";
                            $label = "API {$i}";
                        ?>
                            <li class="nav-item">
                                <a class="<?= getActiveClass($apiName); ?>" href="<?= $href; ?>"><?= $label; ?></a>
                            </li>
                        <?php
                        }
                        ?>
                        <li class="nav-item">
                            <a class="<?= getActiveClass('acerca_de'); ?>" href="/acerca_de.php">Acerca de</a>
                        </li>
                    </ul>
                </div>
                <div class="contenido">
    <?php
    }

    public function __destruct()
    {
    ?>
                </div>
                <footer style="margin-top: 40px;">
                    <hr>
                    <p class="text-center">© 2025 Portal web</p>
                    <p class="author text-center">
                        Desarrollado X <strong>Roniel Sabala ♥</strong>
                    </p>
                </footer>
            </div>
        </body>
        </html>
    <?php
    }
}
