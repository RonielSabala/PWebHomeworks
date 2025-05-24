<?php
require("objetos.php");
require("plantilla.php");

function mostrarMensaje($mensaje, $tipo = "success", $ruta_final = "index.php")
{
    echo "
    <div class='text-center'>
        <div class='alert alert-$tipo'>$mensaje</div>
        <a href='$ruta_final' class='btn btn-primary'>Volver</a>
    </div>
    ";
}

function cargarObra($verify = false)
{
    $obra = new Obra();
    if (isset($_GET['id'])) {
        $ruta = "datos/" . $_GET['id'] . ".json";
        if (file_exists($ruta)) {
            $json = file_get_contents($ruta);
            $obra = json_decode($json);
        }
    }

    plantilla::aplicar();
    if ($verify && !(isset($_GET['id']) && file_exists($ruta))) {
        mostrarMensaje("Error al cargar la obra.", "danger");
        exit();
    }

    return $obra;
}

function guardarObra($obra, $mensajeExito, $ruta_final = "index.php")
{
    if (!is_dir("datos")) {
        mkdir("datos");
    }

    if (is_dir("datos")) {
        $ruta = "datos/" . $obra->codigo . ".json";
        $json = json_encode($obra);
        file_put_contents($ruta, $json);

        $mensaje = $mensajeExito;
        $tipo = "success";
    } else {
        $mensaje = "Error al crear el directorio 'datos'.";
        $tipo = "danger";
    }

    mostrarMensaje($mensaje, $tipo, $ruta_final);
}

function mostrarObra($obra)
{
?>
    <div class="col-md-4">
        <div class="card">
            <img class="card-img-top img-fluid" src="<?= $obra->foto_url ?>" alt="<?= $obra->nombre ?>" style="height:200px; object-fit:cover;">
            <div class="card-body">
                <h5 class="card-title"><?= $obra->nombre; ?></h5>
                <p class="card-text"><strong>Tipo:</strong> <?= tipo_de_obra($obra->tipo) ?></p>
                <p class="card-text"><strong>Autor:</strong> <?= $obra->autor ?></p>
                <p class="card-text"><strong>País:</strong> <?= $obra->pais ?></p>
                <p class="card-text"><strong>Descripción:</strong> <?= $obra->descripcion ?></p>
            </div>
        </div>
    </div>
<?php
}
