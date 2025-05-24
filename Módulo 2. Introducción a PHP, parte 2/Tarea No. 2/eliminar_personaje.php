<?php
include "libreria/principal.php";

plantilla::aplicar();

// Crear una instancia de la clase Obra
$obra = new Obra();
$id = $_GET['id'];
$cedula = $_GET['cedula'];
$ruta = "datos/" . $id . ".json";
if (!is_file($ruta)) {
    mostrarMensaje("Error al cargar la obra.", "danger");
    exit;
}

$json = file_get_contents($ruta);
$obra = json_decode($json);

// Buscar el personaje
$personaje = null;
foreach ($obra->personajes as $p) {
    if ($p->cedula == $cedula) {
        $personaje = $p;
        break;
    }
}

if ($personaje == null) {
    mostrarMensaje("Error al cargar el personaje.", "danger");
    exit;
}

// Eliminar el personaje
$obra->personajes = array_filter($obra->personajes, function ($p) use ($cedula) {
    return $p->cedula != $cedula;
});

// Guardar la obra
file_put_contents($ruta, json_encode($obra));
echo "<div class='text-center'><div class='alert alert-success'>Personaje eliminado exitosamente</div>";
echo "<a href='personajes.php?id=" . $obra->codigo . "' class='btn btn-primary'>Volver</a></div>";
exit;
