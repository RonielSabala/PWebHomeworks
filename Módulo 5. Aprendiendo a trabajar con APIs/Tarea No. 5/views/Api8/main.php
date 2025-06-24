<?php
include("library/principal.php");

// Cargar el API key
require_once __DIR__ . '/../../dependencies/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
$accessKey = $_ENV['UNSPLASH_ACCESS_KEY'] ?? null;

define("PAGINA_ACTUAL", "Api8");
define('API_BASE_URL', 'https://api.unsplash.com/search/photos');
define('API_PARAMS', '?per_page=1&query=');
Preset::apply();

// Variables del formulario
$keyword = "";

// Variables de respuesta
$data  = null;
$error = null;

// Obtener la respuesta de la API
if ($_POST) {
    $keyword  = trim(htmlspecialchars($_POST['keyword']));
    $endpoint = API_BASE_URL . API_PARAMS . urlencode($keyword) . '&client_id=' . $accessKey;
    list($data, $error) = fetchApiData($endpoint);
}

if (!$accessKey) {
    $error = "Error: Unsplash key no configurada.";
}

// Mostrar error si ocurre
if ($error !== null) {
    showAlert($error, "danger", "/views/Api8/main.php");
    exit();
}
?>

<!-- Formulario -->
<div class="container" style="max-width: 1000px;">
    <div class="header">
        <h1 class="display-5"><strong>8. Generador de imágenes con IA</strong></h1>
        <p class="lead">Ingresa una palabra clave para buscar en Unsplash.</p>
    </div>

    <form method="post" class="shadow-sm p-4 rounded">
        <div class="mb-3">
            <label for="keyword" class="form-label">Palabra clave</label>
            <input type="text" id="keyword" name="keyword" class="form-control" value="<?= $keyword ?>" required>
        </div>

        <?php if ($data && isset($data['results'][0])):
            $img          = $data['results'][0]['urls']['regular'] ?? '';
            $photographer = $data['results'][0]['user']['name'] ?? '';
            $profileLink  = $data['results'][0]['user']['links']['html'] ?? '';
        ?>
            <div class="card mb-3">
                <?php if ($img): ?>
                    <img src="<?= htmlspecialchars($img) ?>" alt="Imagen de <?= htmlspecialchars($keyword) ?>" class="card-img-top img-fluid">
                <?php endif; ?>
                <div class="card-body">
                    <p class="mb-0">Crédito: <a href="<?= htmlspecialchars($profileLink) ?>?utm_source=tu_app&utm_medium=referral" target="_blank"><?= htmlspecialchars($photographer) ?></a> en Unsplash</p>
                </div>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-success btn-lg mt-4">Generar Imagen</button>
    </form>
</div>