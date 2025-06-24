<?php
include("library/principal.php");

define("PAGINA_ACTUAL", "Api10");
define('API_BASE_URL', 'https://official-joke-api.appspot.com/random_joke');
Preset::apply();

// Variables de respuesta
$data = null;
$error = null;

// Obtener la respuesta de la API
list($data, $error) = fetchApiData(API_BASE_URL);

// Mostrar error si ocurre
if ($error !== null) {
    showAlert($error, "danger", "/views/Api10/main.php");
    exit();
}
?>

<!-- Formulario -->
<div class="container" style="max-width: 1000px;">
    <div class="header">
        <h1 class="display-5"><strong>10. Generador de chistes</strong></h1>
        <p class="lead">Ríete de un chiste aleatorio cada vez que entres a la página.</p>
    </div>

    <?php if ($data): ?>
        <div class="card">
            <div class="card-body">
                <p class="h5 mb-3"><?= htmlspecialchars($data['setup'] ?? '...') ?></p>
                <p class="fw-bold"><?= htmlspecialchars($data['punchline'] ?? '') ?></p>
            </div>
        </div>
        <a href="?" class="btn btn-success btn-lg mt-4">Otro chiste!</a>
    <?php endif; ?>
</div>