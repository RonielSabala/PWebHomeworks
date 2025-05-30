<?php

$pagina_actual = "";

function actualizarPagina()
{
    global $pagina_actual;
    $pagina_actual = defined("PAGINA_ACTUAL") ? PAGINA_ACTUAL : "inicio";
}

function getActiveClass($targetPage)
{
    global $pagina_actual;
    return "barbie-link nav-link " . (($pagina_actual === $targetPage) ? 'active' : '');
}

class plantilla
{
    public static $instance = null;
    public static function aplicar(): plantilla
    {
        if (self::$instance == null) {
            self::$instance = new plantilla();
        }

        return self::$instance;
    }

    public function __construct()
    {
        actualizarPagina();
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
            <link href="https://fonts.cdnfonts.com/css/barbie" rel="stylesheet">
            <title>Mundo Barbie</title>
            <style>
                .container {
                    max-width: 1200px;
                    padding: 0 80px;
                    border-radius: 15px;
                }

                .page-name-link {
                    text-decoration: none;
                }

                .page-name {
                    margin-top: 20px;
                    font-size: 85px;
                    color: rgb(238, 78, 201);
                    font-family: 'Barbie', sans-serif;
                }

                .nav {
                    font-size: 25px;
                    border-bottom: 1px solid rgb(238, 78, 201);
                }

                .nav-link {
                    color: rgb(6, 112, 206);
                }

                .barbie-link.nav-link:hover {
                    color: rgb(238, 78, 201);
                    border-color: rgb(238, 78, 201);
                    border-bottom-color: white;
                }

                .barbie-link.nav-link.active {
                    color: rgb(238, 78, 201);
                    border-color: rgb(238, 78, 201);
                    border-bottom-color: white;
                }

                .author {
                    color: #EE4EC5;
                    font-size: 20px;
                    font-family: cursive;
                }
            </style>
        </head>

        <body>
            <div class="container">
                <div>
                    <a class="page-name-link" href="/">
                        <h1 class="page-name">Mundo Barbie</h1>
                    </a>
                </div>
                <div class="divMenu">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="<?= getActiveClass('inicio'); ?>" href="/">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="<?= getActiveClass('personajes'); ?>" href="<?= base_url('modulos/personajes/lista.php'); ?>">Personajes</a>
                        </li>
                        <li class="nav-item">
                            <a class="<?= getActiveClass('profesiones'); ?>" href="<?= base_url('modulos/profesiones/lista.php'); ?>">Profesiones</a>
                        </li>
                        <li class="nav-item">
                            <a class="<?= getActiveClass('estadisticas'); ?>" href="<?= base_url('modulos/reportes/menu.php'); ?>">Estadísticas</a>
                        </li>
                    </ul>
                </div>
                <div class="contenido" style="min-height: 600px; margin-top: 20px;">
    <?php
    }

    public function __destruct()
    {
    ?>
                </div>
                <div class="footer" style="margin-top: 40px;">
                    <hr>
                    <p class="text-center">© 2025 Mundo Barbie</p>
                    <p class="author text-center">
                        Desarrollado X <strong>Roniel Sabala ♥</strong>
                    </p>
                </div>
            </div>
        </body>

        </html>
    <?php
    }
}
