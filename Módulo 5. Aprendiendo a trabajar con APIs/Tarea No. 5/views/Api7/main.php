<?php
include("library/principal.php");

define("PAGINA_ACTUAL", "Api7");
define('API_BASE_URL', 'https://api.exchangerate-api.com/v4/latest/');
Preset::apply();

// Variables del formulario
$monto = '';
$monedaBase = 'USD';

// Variables de respuesta
$data = null;
$error = null;

// Obtener la respuesta de la API
if ($_POST) {
    $monto = trim(htmlspecialchars($_POST['monto']));
    $monedaBase = trim(htmlspecialchars($_POST['monedaBase']));
    $endpoint = API_BASE_URL . urlencode($monedaBase);
    list($data, $error) = fetchApiData($endpoint);
}

// Mostrar error si ocurre
if ($error !== null) {
    showAlert($error, "danger", "/views/Api7/main.php");
    exit();
}
?>

<!-- Formulario -->
<div class="container" style="max-width: 1000px;">
    <div class="header">
        <h1 class="display-5"><strong>7. Conversión de Monedas</strong></h1>
        <p class="lead">Ingresa una cantidad en <?= htmlspecialchars($monedaBase) ?> para convertirla a DOP y otras monedas.</p>
    </div>

    <form method="post" class="shadow-sm p-4 rounded">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="monto" class="form-label">Cantidad (<?= htmlspecialchars($monedaBase) ?>)</label>
                <input type="number" step="any" id="monto" name="monto" class="form-control" value="<?= $monto ?>" required>
            </div>
            <div class="col-md-6">
                <label for="monedaBase" class="form-label">Moneda base</label>
                <select id="monedaBase" name="monedaBase" class="form-select">
                    <option value="USD" <?= $monedaBase === 'USD' ? 'selected' : '' ?>>USD</option>
                    <option value="EUR" <?= $monedaBase === 'EUR' ? 'selected' : '' ?>>EUR</option>
                    <option value="GBP" <?= $monedaBase === 'GBP' ? 'selected' : '' ?>>GBP</option>
                </select>
            </div>
        </div>

        <?php if ($data): ?>
            <div class="row mt-4">
                <?php
                $monedas = ['DOP', 'EUR', 'GBP', 'MXN'];
                foreach ($monedas as $moneda) {
                    if (isset($data['rates'][$moneda])) {
                        $tasa = $data['rates'][$moneda];
                        $valorConvertido = number_format($monto * $tasa, 2);
                ?>
                        <div class="col-md-3 mb-3">
                            <div class="card text-center shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $moneda ?></h5>
                                    <p class="card-text display-6 mb-0"><?= $valorConvertido ?></p>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-success btn-lg mt-4">Convertir</button>
    </form>
</div>