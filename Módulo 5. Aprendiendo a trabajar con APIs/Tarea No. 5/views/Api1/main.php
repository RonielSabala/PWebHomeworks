<?php
include("library/principal.php");

define("PAGINA_ACTUAL", "Api1");
define('API_BASE_URL', 'https://api.genderize.io?name=');
Preset::apply();

// Variables del formulario
$nombre = "";

// Variables de respuesta
$data = null;
$error = null;

// Obtener la respuesta de la API
if ($_POST) {
    $nombre = trim(htmlspecialchars($_POST["nombre"]));
    list($data, $error) = fetchApiData(API_BASE_URL . urlencode($nombre));
}

// Mostrar error si ocurre
if ($error !== null) {
    showAlert($error, "danger", "/views/Api1/main.php");
    exit();
}
?>

<!-- Formulario -->
<div class="container" style="max-width: 1000px;">
    <div class="header">
        <h1 class="display-5"><strong>1. Predicción de Género</strong></h1>
        <p class="lead">Ingresa un nombre para clasificarlo como masculino o femenino.</p>
    </div>

    <form method="post" class="shadow-sm p-4 rounded">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="<?= $nombre ?>" required>
        </div>

        <?php if ($data): ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Resultado</h5>
                    <p class="mb-2">Género predicho: <strong><?= htmlspecialchars(ucfirst($data['gender'] ?? 'Desconocido')) ?></strong></p>
                    <p class="mb-0">Probabilidad: <strong><?= isset($data['probability']) ? number_format($data['probability'] * 100, 2) . '%' : 'N/A' ?></strong></p>
                </div>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-success btn-lg mt-4">Predecir</button>
    </form>
</div>