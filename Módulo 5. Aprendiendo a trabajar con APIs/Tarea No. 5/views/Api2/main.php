<?php
include("library/principal.php");

define("PAGINA_ACTUAL", "Api2");
define('API_BASE_URL', 'https://api.agify.io/?name=');
Preset::apply();

// Variables del formulario
$nombre = "";

// Variables de respuesta
$data  = null;
$error = null;

// Obtener la respuesta de la API
if ($_POST) {
    $nombre = trim(htmlspecialchars($_POST["nombre"]));
    list($data, $error) = fetchApiData(API_BASE_URL . urlencode($nombre));
}

// Mostrar error si ocurre
if ($error !== null) {
    showAlert($error, "danger", "/views/Api2/main.php");
    exit();
}
?>

<!-- Formulario -->
<div class="container" style="max-width: 1000px;">
    <div class="header">
        <h1 class="display-5"><strong>2. Predicción de Edad</strong></h1>
        <p class="lead">Ingresa un nombre para estimar su edad.</p>
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
                    <p class="mb-2">Edad estimada: <strong><?= isset($data['age']) ? $data['age'] . ' años' : 'Desconocido' ?></strong></p>
                    <?php if (isset($data['age'])):
                        $age = (int) $data['age'];
                        if ($age < 18) {
                            $label = 'Joven';
                            $emoji = '👶';
                        } elseif ($age <= 65) {
                            $label = 'Adulto';
                            $emoji = '🧑';
                        } else {
                            $label = 'Anciano';
                            $emoji = '👴';
                        }
                    ?>
                        <p class="mb-2">Categoría: <strong><?= $label . ' ' . $emoji ?></strong></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-success btn-lg mt-4">Predecir</button>
    </form>
</div>