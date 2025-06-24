<?php
include("library/principal.php");

define("PAGINA_ACTUAL", "Api6");
define('API_BASE_URL', '');
Preset::apply();

// Variables del formulario
$site = "";

// Variables de respuesta
$data = null;
$error = null;

// Obtener la respuesta de la API
if ($_POST) {
    $site = rtrim(trim(htmlspecialchars($_POST['site'])), "/");
    $endpoint = $site . '/wp-json/wp/v2/posts?per_page=3&_fields=title,excerpt,link';
    list($data, $error) = fetchApiData($endpoint);
}

// Mostrar error si ocurre
if ($error !== null) {
    showAlert($error, "danger", "/views/Api6/main.php");
    exit();
}
?>

<!-- Formulario -->
<div class="container" style="max-width: 1000px;">
    <div class="header">
        <h1 class="display-5"><strong>6. Noticias desde WordPress</strong></h1>
        <p class="lead">Selecciona una página de noticias para extraer las últimas 3 entradas.</p>
    </div>

    <form method="post" class="shadow-sm p-4 rounded">
        <div class="mb-3">
            <label for="site" class="form-label">URL del sitio</label>
            <input type="url" id="site" name="site" class="form-control" value="<?= $site ?>" required>
        </div>

        <?php if ($data): ?>
            <div class="mb-3 text-center">
                <img src="<?= htmlspecialchars($site) ?>/favicon.ico" alt="Logo del sitio" style="width:60px;height:60px;" class="mb-2">
                <p class="mb-0"><strong><?= htmlspecialchars(parse_url($site, PHP_URL_HOST)) ?></strong></p>
            </div>
            <?php foreach ($data as $post): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars(strip_tags($post['title']['rendered'])) ?></h5>
                        <p class="card-text"><?= htmlspecialchars(strip_tags($post['excerpt']['rendered'])) ?></p>
                        <a href="<?= htmlspecialchars($post['link']) ?>" class="btn btn-primary" target="_blank">Leer más</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <button type="submit" class="btn btn-success btn-lg mt-4">Cargar Noticias</button>
    </form>
</div>