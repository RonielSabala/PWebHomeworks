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

                <title>Lo que he visto</title>
            </head>

            <body>
                <div class="container">
                    <a href="index.php">
                        <h1 class="mt-3">Lo que he visto</h1>
                    </a>
                    <p>Listado de películas y series en la que he invertido mi tiempo.</p>

                    <div style="min-height: 500px;">
        <?php
    }

    public function __destruct()
    {
        ?>
                    </div>
                    <div class="text-center">
                        <hr>
                        Derechos reservados &copy; <?= date("Y") ?> - Lo que he visto
                    </div>
                </div>
            </body>
            </html>
        <?php
    }
}
