<?php
include("library/principal.php");

// Cargar la api key
require_once __DIR__ . '/../../dependencies/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
$apiKey = $_ENV['OPENWEATHER_API_KEY'] ?? null;

define("PAGINA_ACTUAL", "Api4");
define('API_BASE_URL', 'https://api.openweathermap.org/data/2.5/weather?q=');
define('API_PARAMS', '&appid=' . $apiKey . '&units=metric&lang=es');
Preset::apply();

// Variables del formulario
$ciudad = "";

// Variables de respuesta
$data  = null;
$error = null;

// Obtener la respuesta de la API
if ($_POST) {
    $ciudad = trim(htmlspecialchars($_POST['ciudad']));
    list($data, $error) = fetchApiData(API_BASE_URL . urlencode($ciudad) . API_PARAMS);
}

if (!$apiKey) {
    $error = "Error: API key no configurada.";
}

// Mostrar error si ocurre
if ($error !== null) {
    showAlert($error, "danger", "/views/Api4/main.php");
    exit();
}
?>

<!-- Formulario -->
<div class="container" style="max-width: 1000px;">
    <div class="header">
        <h1 class="display-5"><strong>4. Clima en República Dominicana</strong></h1>
        <p class="lead">Ingresa una ciudad para ver el clima actual.</p>
    </div>

    <form method="post" class="shadow-sm p-4 rounded">
        <div class="mb-3">
            <label for="ciudad" class="form-label">Ciudad</label>
            <input type="text" id="ciudad" name="ciudad" class="form-control" value="<?= $ciudad ?>" required>
        </div>

        <?php if ($data):
            $weather = $data['weather'][0] ?? [];
            $main    = strtolower($weather['main'] ?? '');
            // Definir estilos según condición
            switch ($main) {
                case 'clear':
                    $bg = 'bg-warning bg-opacity-25';
                    break;
                case 'rain':
                case 'drizzle':
                case 'thunderstorm':
                    $bg = 'bg-primary bg-opacity-25';
                    break;
                case 'clouds':
                    $bg = 'bg-secondary bg-opacity-25';
                    break;
                default:
                    $bg = 'bg-light';
            }
            $icon = $weather['icon'] ?? '';
            $desc = ucfirst($weather['description'] ?? '');
        ?>
            <div class="card mb-3 <?= $bg ?>">
                <div class="card-body d-flex align-items-center">
                    <?php if ($icon): ?>
                        <img src="https://openweathermap.org/img/wn/<?= $icon ?>@2x.png" alt="Ícono del clima" class="me-3">
                    <?php endif; ?>
                    <div>
                        <h5 class="card-title mb-1"><?= htmlspecialchars($data['name'] ?? $ciudad) ?></h5>
                        <p class="mb-2">Condición: <strong><?= htmlspecialchars($desc) ?></strong></p>
                        <p class="mb-0">Temperatura: <strong><?= isset($data['main']['temp']) ? number_format($data['main']['temp'], 1) . '°C' : 'N/A' ?></strong></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-success btn-lg mt-4">Buscar</button>
    </form>
</div>