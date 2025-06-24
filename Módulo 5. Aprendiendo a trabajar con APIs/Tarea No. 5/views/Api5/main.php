<?php
include("library/principal.php");

define("PAGINA_ACTUAL", "Api5");
define('API_BASE_URL', 'https://pokeapi.co/api/v2/pokemon/');
Preset::apply();

// Variables del formulario
$pokeName = "";
$audioUrl = "https://play.pokemonshowdown.com/audio/cries";

// Variables de respuesta
$data  = null;
$error = null;

// Obtener la respuesta de la API
if ($_POST) {
    $pokeName = trim(strtolower(htmlspecialchars($_POST['pokeName'])));
    list($data, $error) = fetchApiData(API_BASE_URL . urlencode($pokeName));
}

// Mostrar error si ocurre
if ($error !== null) {
    showAlert($error, "danger", "/views/Api5/main.php");
    exit();
}
?>

<!-- Formulario -->
<div class="container" style="max-width: 1000px;">
    <div class="header">
        <h1 class="display-5"><strong>5. Información de un Pokémon</strong></h1>
        <p class="lead">Ingresa un Pokémon para ver su información.</p>
    </div>

    <form method="post" class="shadow-sm p-4 rounded">
        <div class="mb-3">
            <label for="pokeName" class="form-label">Nombre del Pokémon</label>
            <input type="text" id="pokeName" name="pokeName" class="form-control" value="<?= $pokeName ?>" required>
        </div>

        <?php if ($data):
            // Datos Pokémon
            $sprite = $data['sprites']['front_default'] ?? '';
            $exp    = $data['base_experience'] ?? 'N/A';
            $abilities = array_map(function ($a) {
                return $a['ability']['name'];
            }, $data['abilities'] ?? []);
        ?>
            <div class="card mb-3">
                <div class="card-body d-flex align-items-center">
                    <?php if ($sprite): ?>
                        <img src="<?= $sprite ?>" alt="Imagen de <?= htmlspecialchars($pokeName) ?>" class="me-4" style="width:120px;height:120px;">
                    <?php endif; ?>
                    <div>
                        <h5 class="card-title mb-2 text-capitalize"><?= htmlspecialchars($pokeName) ?></h5>
                        <p class="mb-1">Experiencia base: <strong><?= htmlspecialchars($exp) ?></strong></p>
                        <p class="mb-1">Habilidades:</p>
                        <ul class="mb-2">
                            <?php foreach ($abilities as $ability): ?>
                                <li class="text-capitalize"><?= htmlspecialchars($ability) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <audio controls>
                            <source src='<?= $audioUrl . "/{$pokeName}.mp3" ?>' type="audio/mpeg">
                            Tu navegador no soporta reproducción de audio.
                        </audio>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-success btn-lg mt-4">Buscar</button>
    </form>
</div>