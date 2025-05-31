<?php
include("plantilla.php");
include("modelos.php");
include("Dbx.php");

function base_url($path = "")
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $path = trim($path, "/");
    return $protocol . $host . "/" . $path;
}

function obtener_promedio($a, $b, $decimales = 2)
{
    if ($a === 0) {
        return 0;
    }

    return number_format($b > 0 ? $a / $b : 0, $decimales);
}

function cargar_editar($collection_name, $CollectionClass)
{
    if (!defined("PAGINA_ACTUAL")) {
        define("PAGINA_ACTUAL", $collection_name);
    }

    if ($_POST) {
        $entity = new $CollectionClass(data: $_POST);
        Dbx::save($collection_name, $entity);
        header("Location: " . base_url("modulos/{$collection_name}/lista.php"));
        exit;
    }

    if (isset($_GET["idx"])) {
        $entity = Dbx::get($collection_name, $_GET["idx"]);
    } else {
        $entity = new $CollectionClass();
    }

    return $entity;
}

function cargar_eliminar($collection)
{
    if (!defined("PAGINA_ACTUAL")) {
        define("PAGINA_ACTUAL", $collection);
        plantilla::aplicar();
    }

    // Variables
    $ruta = "libreria/datax/$collection";
    $idx = isset($_GET['idx']) ? $_GET['idx'] : "";
    $file = "{$ruta}/{$idx}dat";

    // Manejar error
    if ($idx === "" || !is_dir($ruta) || !file_exists($file)) {
        echo "
        <div class='text-center'>
            <div class='alert alert-danger'>Error al encontrar el objeto!</div>
            <a href='lista.php' class='btn btn-primary'>Volver</a>
        </div>
        ";

        exit;
    }

    // Eliminar archivo
    unlink($file);
    echo "<div class='text-center'><div class='alert alert-success'>Eliminado exitosamente!</div>";
    echo "<a href='lista.php' class='btn btn-primary'>Volver</a></div>";
}
