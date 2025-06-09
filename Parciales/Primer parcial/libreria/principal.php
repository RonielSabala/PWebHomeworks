<!-- Roniel Sabala, 20240212 -->
<?php
include("libreria/objetos.php");
include("libreria/plantilla.php");

function mostrarMensaje($mensaje, $tipo = "success")
{
    echo "
        <div class='text-center'>
            <div class='alert alert-$tipo'>$mensaje</div>
            <a href='index.php' class='btn btn-primary'>Volver</a>
        </div>
    ";
}
