<?php

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
        $pagina_actual = defined("PAGINA_ACTUAL") ? PAGINA_ACTUAL : "inicio";

    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Mundo Barbie</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
            <link href="https://fonts.googleapis.com/css2?family=Barbie+Regular&display=swap" rel="stylesheet">
            <style>
                a {
                    background-color: transparent;
                    color: rgb(238, 78, 201);
                }

                .nav-link.active {
                    background-color: rgb(238, 78, 201, 0.1) !important;
                    color: rgb(238, 78, 201) !important;
                }
            </style>
        </head>

        <body>
            <div class="container">
                <div>
                    <h1>Mundo Barbie</h1>
                </div>
                <div class="divMenu">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link <?= $pagina_actual == 'inicio' ? 'active' : ''; ?>" aria-current="page" href="/">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $pagina_actual == 'personajes' ? 'active' : ''; ?>" href="<?= base_url('modulos/personajes/lista.php'); ?>">Personajes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $pagina_actual == 'profesiones' ? 'active' : ''; ?>" href="<?= base_url('modulos/profesiones/lista.php'); ?>">Profesiones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $pagina_actual == 'estadisticas' ? 'active' : ''; ?>" href="<?= base_url('modulos/reportes/menu.php'); ?>">Estadísticas</a>
                        </li>
                    </ul>
                </div>
                <div class="contenido" style="min-height: 600px;">
    <?php
    }

    public function __destruct()
    {
    ?>
                </div>
                <div class="footer">
                    <hr>
                    <p class="text-center">© 2025 Mundo Barbie</p>
                </div>
            </div>
        </body>

        </html>
    <?php
    }
}
