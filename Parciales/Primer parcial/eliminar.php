<!-- Roniel Sabala, 20240212 -->
<?php
include("libreria/principal.php");
Plantilla::aplicar();

if (isset($_GET["idx"])) {
    $ruta = "datos/" . $_GET["idx"] . ".json";
    if (!is_file($ruta)) {
        mostrarMensaje("Error al encontrar la cita.", "danger");
        exit();
    }

    unlink($ruta);
    mostrarMensaje("Cita eliminada exitosamente.");
} else {
    mostrarMensaje("No sé especificó ninguna cita a eliminar.", "danger");
}
