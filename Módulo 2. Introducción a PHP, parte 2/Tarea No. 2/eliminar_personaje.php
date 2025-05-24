<?php

include "libreria/principal.php";

$id = $_GET['id'];
$cedula = $_GET['cedula'];

//carga la obra

$obra = new Obra();
$ruta = "datos/" . $id . ".json";

if (!is_file($ruta)) {
    plantilla::aplicar();
    echo "<div class='text-center'><div class='alert alert-danger'>Error al cargar la obra</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver</a></div>";
    exit();
}

$json = file_get_contents($ruta);
$obra = json_decode($json);

// buscar el personaje
$personaje = null;

foreach ($obra->personajes as $p) {
    if ($p->cedula == $cedula) {
        $personaje = $p;
        break;
    }
}

if ($personaje == null) {
    plantilla::aplicar();
    echo "<div class='text-center'><div class='alert alert-danger'>Error al cargar el personaje</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver</a></div>";
    exit();
}

// Eliminar el personaje
$obra->personajes = array_filter($obra->personajes, function ($p) use ($cedula) {
    return $p->cedula != $cedula;
});

// Guardar la obra
file_put_contents($ruta, json_encode($obra));
plantilla::aplicar();

echo "<div class='text-center'><div class='alert alert-success'>Personaje eliminado exitosamente</div>";
echo "<a href='personajes.php?id=" . $obra->codigo . "' class='btn btn-primary'>Volver</a></div>";
exit();
