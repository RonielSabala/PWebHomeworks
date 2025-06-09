<!-- Roniel Sabala, 20240212 -->
<?php

class Plantilla
{
    public static $instancia = null;

    public static function aplicar()
    {
        if (is_null(self::$instancia)) {
            self::$instancia = new Plantilla();
        }

        return self::$instancia;
    }

    public function __construct()
    {
    ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Consultorio dental</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
        </head>
        <body>
            <h1 class="text-center mt-3"><a href="index.php">Consultorio</a> para mis pacientes</h1>
            <p class="text-center mt-3">
                Esta es mi página web para gestionar las citas de mis pacientes.<br>
                Sientete libre de disfrutar como la construyo.
            </p>
            <hr>
            <div class="container" style="min-height: 650px;">
    <?php
    }

    public function __destruct()
    {
    ?>
            </div>
            <hr>
            <footer class="text-center">
                <p>Desarrollado X <strong>Roniel Sabala ♥</strong></p>
            </footer>
        </body>
        </html>
    <?php
    }
}
