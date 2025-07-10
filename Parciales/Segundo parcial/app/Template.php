<!-- Roniel Sabala, 20240212 -->
<?php

class Template
{
    public static $instance = null;
    
    public static function apply()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Template();
        }

        return self::$instance;
    }

    public function __construct()
    {
    ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Segundo parcial</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
            <link
                rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" />
        </head>
        <body>
            <h1 class="text-center mt-3"><a href="index.php">Visitas</a> de la empresa</h1>
            <p class="text-center mt-4">Esta es mi página web para gestionar las visitas de mi empresa.</p>
            <div class="container" style="min-height: 650px;">
                <hr>
    <?php
    }

    public function __destruct()
    {
    ?>
            </div>
            <hr>
            <footer class="text-center">
                <p>Desarrollado X Roniel Sabala ♥</p>
            </footer>
        </body>
        </html>
    <?php
    }
}
