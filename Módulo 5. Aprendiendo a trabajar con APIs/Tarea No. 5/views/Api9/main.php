<?php
include("library/principal.php");

define("PAGINA_ACTUAL", "Api9");
define('API_BASE_URL', 'https://restcountries.com/v3.1/name/');
Preset::apply();

// Variables del formulario
$pais = "";

// Variables de respuesta
$data = null;
$error = null;

// Obtener la respuesta de la API
if ($_POST) {
    $pais = trim(htmlspecialchars($_POST['pais']));
    list($data, $error) = fetchApiData(API_BASE_URL . urlencode($pais));
}

// Mostrar error si ocurre
if ($error !== null) {
    showAlert($error, "danger", "/views/Api9/main.php");
    exit();
}
?>

<!-- Formulario -->
<div class="container" style="max-width: 1000px;">
    <div class="header">
        <h1 class="display-5"><strong>9. Datos de un país</strong></h1>
        <p class="lead">Ingresa el nombre de un país para mostrar sus datos.</p>
    </div>

    <form method="post" class="shadow-sm p-4 rounded">
        <div class="mb-3">
            <label for="pais" class="form-label">País</label>
            <input type="text" id="pais" name="pais" class="form-control" value="<?= $pais ?>" required>
        </div>

        <?php if ($data && is_array($data)):
            $info = $data[0];
            $bandera = $info['flags']['svg'] ?? '';
            $capital = isset($info['capital'][0]) ? $info['capital'][0] : 'N/A';
            $poblacion = $info['population'] ?? 'N/A';
            $monedas = $info['currencies'] ?? [];
            $monedaList = array_map(function ($code, $cur) {
                return $cur['name'] . " (" . $code . ")";
            }, array_keys($monedas), $monedas);
        ?>
            <div class="card mb-3">
                <?php if ($bandera): ?>
                    <img src="<?= htmlspecialchars($bandera) ?>" alt="Bandera de <?= htmlspecialchars($pais) ?>" class="card-img-top img-fluid">
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($info['name']['common'] ?? $pais) ?></h5>
                    <p class="mb-2">Capital: <strong><?= htmlspecialchars($capital) ?></strong></p>
                    <p class="mb-2">Población: <strong><?= number_format($poblacion, 0, ',', '.') ?></strong></p>
                    <p class="mb-0">Moneda(s): <strong><?= htmlspecialchars(implode(', ', $monedaList)) ?></strong></p>
                </div>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-success btn-lg mt-4">Buscar</button>
    </form>
</div>