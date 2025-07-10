<!-- Roniel Sabala, 20240212 -->
<?php
include("app/includes.php");

Template::apply();

if ($_POST) {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];

    if (empty($id)) {
        // Crear una nueva visita
        $sql = "INSERT INTO visitas (nombre, apellido, telefono, correo) VALUES (?, ?, ?, ?)";
        $params = [$nombre, $apellido, $telefono, $correo];
    } else {
        // Editar la visita
        $sql = "UPDATE visitas SET nombre = ?, apellido = ?, telefono = ?, correo = ? WHERE id = ?";
        $params = [$nombre, $apellido, $telefono, $correo, $id];
    }

    modifyVisit($pdo, $sql, $params);
    showAlert("Visita guardada exitosamente!", "success");
    exit;
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $visita = getVisitById($pdo, $id);
}

$id ??= "";
$nombre = $visita->nombre ?? "";
$apellido = $visita->apellido ?? "";
$telefono = $visita->telefono ?? "";
$correo = $visita->correo ?? "";
?>

<h2>Datos de la visita</h2>
<form method="post">
    <!-- Id -->
    <div class="mt-4" hidden>
        <label class="form-label" for="id">Id</label>
        <input class="form-control" type="text" id="id" name="id" value="<?= htmlspecialchars($id); ?>">
    </div>

    <!-- Nombre -->
    <div class="mt-4">
        <label class="form-label" for="nombre">Nombre</label>
        <input required class="form-control" type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($nombre); ?>">
    </div>

    <!-- Apellido -->
    <div class="mt-4">
        <label class="form-label" for="apellido">Apellido</label>
        <input required class="form-control" type="text" id="apellido" name="apellido" value="<?= htmlspecialchars($apellido); ?>">
    </div>

    <!-- Teléfono -->
    <div class="mt-4">
        <label class="form-label" for="telefono">Teléfono</label>
        <input required class="form-control" type="tel" id="telefono" name="telefono" value="<?= htmlspecialchars($telefono); ?>">
    </div>

    <!-- Correo-->
    <div class="mt-4">
        <label class="form-label" for="correo">Correo</label>
        <input required class="form-control" type="email" id="correo" name="correo" value="<?= htmlspecialchars($correo); ?>">
    </div>

    <button type="submit" class="btn btn-primary mt-4">Guardar</button>
    <a href="index.php" class="btn btn-secondary mt-4">Cancelar</a>
</form>