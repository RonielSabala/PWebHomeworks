<!-- Roniel Sabala, 20240212 -->
<?php
include("libreria/principal.php");
Plantilla::aplicar();

$cita = new Cita();
if ($_POST) {
    $cita->idx = $_POST["idx"];
    $cita->nombre = $_POST["nombre"];
    $cita->apellido = $_POST["apellido"];
    $cita->cedula = $_POST["cedula"];
    $cita->edad = $_POST["edad"];
    $cita->motivo = $_POST["motivo"];
    $cita->fecha = $_POST["fecha"];

    if (!is_dir("datos")) {
        mkdir("datos");
    }

    $ruta = "datos/" . $cita->idx . ".json";
    $json = json_encode($cita);
    file_put_contents($ruta, $json);
    mostrarMensaje("Cita guardada exitosamente.");
    exit();
}

if (isset($_GET["idx"])) {
    $ruta = "datos/" . $_GET["idx"] . ".json";
    if (!is_file($ruta)) {
        mostrarMensaje("Error al encontrar la cita.", "danger");
        exit();
    }

    $json = file_get_contents($ruta);
    $cita = json_decode($json);
} else {
    $cita->idx = uniqid();
}
?>

<h3>Datos de la cita</h3>
<form action="editar.php" method="post" class="form">
    <div class="mt-4" hidden>
        <label class="form-label" for="idx">Idx</label>
        <input required class="form-control" type="text" id="idx" name="idx" value="<?= htmlspecialchars($cita->idx); ?>">
    </div>
    <div class="mt-4">
        <label class="form-label" for="nombre">Nombre</label>
        <input required class="form-control" type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($cita->nombre); ?>">
    </div>
    <div class="mt-4">
        <label class="form-label" for="apellido">Apellido</label>
        <input required class="form-control" type="text" id="apellido" name="apellido" value="<?= htmlspecialchars($cita->apellido); ?>">
    </div>
    <div class="mt-4">
        <label class="form-label" for="cedula">Cédula</label>
        <input required class="form-control" type="text" id="cedula" name="cedula" value="<?= htmlspecialchars($cita->cedula); ?>">
    </div>
    <div class="mt-4">
        <label class="form-label" for="edad">Edad</label>
        <input required class="form-control" type="int" id="edad" name="edad" value="<?= htmlspecialchars($cita->edad); ?>">
    </div>
    <div class="mt-4">
        <label class="form-label" for="motivo">Motivo</label>
        <textarea required class="form-control" type="text" id="motivo" name="motivo"><?= htmlspecialchars($cita->motivo); ?></textarea>
    </div>
    <div class="mt-4">
        <label class="form-label" for="fecha">Fecha de la cita</label>
        <input required class="form-control" type="datetime-local" id="fecha" name="fecha" value="<?= htmlspecialchars($cita->fecha); ?>">
    </div>
    <button class="btn btn-primary mt-4" type="submit">Guardar</button>
    <a href="index.php" class="btn btn-secondary mt-4" type="submit">Cancelar</a>
</form>