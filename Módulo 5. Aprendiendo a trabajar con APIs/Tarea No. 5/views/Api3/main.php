<?php
include("library/principal.php");

define("PAGINA_ACTUAL", "Api3");
define('API_BASE_URL', 'http://universities.hipolabs.com/search?country=');
Preset::apply();

// Variables del formulario
$pais = "";

// Variables de respuesta
$data  = null;
$error = null;

// Obtener la respuesta de la API
if ($_POST) {
    $pais = trim(htmlspecialchars($_POST["pais"]));
    list($data, $error) = fetchApiData(API_BASE_URL . urlencode($pais));
}

// Mostrar error si ocurre
if ($error !== null) {
    showAlert($error, "danger", "/views/Api3/main.php");
    exit();
}
?>

<!-- Formulario -->
<div class="container" style="max-width: 1000px;">
    <div class="header">
        <h1 class="display-5"><strong>3. Universidades de un país</strong></h1>
        <p class="lead">Ingresa el nombre de un país para mostrar sus universidades.</p>
    </div>

    <form method="post" class="shadow-sm p-4 rounded">
        <div class="mb-3">
            <label for="pais" class="form-label">País</label>
            <input type="text" id="pais" name="pais" class="form-control" value="<?= $pais ?>" required>
        </div>

        <?php if ($data): ?>
            <?php foreach ($data as $uni): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($uni['name']) ?></h5>
                        <p class="mb-1">Dominio: <strong><?= htmlspecialchars($uni['domains'][0] ?? 'N/A') ?></strong></p>
                        <p class="mb-0">Página web: <a href="<?= htmlspecialchars($uni['web_pages'][0] ?? '#') ?>" target="_blank"><?= htmlspecialchars($uni['web_pages'][0] ?? 'N/A') ?></a></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <button type="submit" class="btn btn-success btn-lg mt-4">Buscar</button>
    </form>
</div>