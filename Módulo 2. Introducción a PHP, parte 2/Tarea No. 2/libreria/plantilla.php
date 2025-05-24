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
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

            <title>Tarea No. 2. Roniel Sabala</title>
        </head>

        <body>
            <div class="container">
                <a href="index.php">
                    <h1 class="mt-3">🎬Pelis y series</h1>
                </a>
                <p>
                    Este es mi listado de películas y series.<br> Si a ti, al igual que yo, te gusta alguno de estos contenidos, por favor escríbeme.
                </p>

                <div style="min-height: 500px;">
    <?php
    }

    public function __destruct()
    {
    ?>
                </div>
                <div class="text-center" style="margin: 50px 0;"">
                    <hr>
                    Derechos reservados &copy; <?= date("Y") ?> - Pelis y series<br>
                    Desarrollador: <strong>Roniel Sabala &hearts;</strong>
                </div>
            </div>
        </body>

        </html>
    <?php
    }
}
