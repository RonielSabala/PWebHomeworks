<?php
require_once __DIR__ . '/../app/Helpers/utils.php';
require_once __DIR__ . '/../config/db_config.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;
use function App\Helpers\{showAlert, obtenerPersonajePorId};

define('CURRENT_PAGE', 'index');

if (!isset($_GET['id'])) {
    showAlert('No se especificó el personaje.', 'danger');
    exit;
}

$id = intval($_GET['id']);
$personaje = obtenerPersonajePorId($pdo, $id);
if ($personaje === null) {
    showAlert('Personaje no encontrado.', 'danger');
    exit;
}

// Data para la vista
$data = [
    'nombre' => htmlspecialchars($personaje->nombre, ENT_QUOTES, 'UTF-8'),
    'color'  => htmlspecialchars($personaje->color,  ENT_QUOTES, 'UTF-8'),
    'tipo'   => htmlspecialchars($personaje->tipo,   ENT_QUOTES, 'UTF-8'),
    'nivel'  => htmlspecialchars($personaje->nivel,  ENT_QUOTES, 'UTF-8'),
    'foto'   => htmlspecialchars($personaje->foto,   ENT_QUOTES, 'UTF-8'),
];

// Iniciar el buffer y cargar la vista como PHP
ob_start();
extract($data, EXTR_SKIP);

// Cargar el CSS
$cssPath = __DIR__ . '/../public/css/pages/pdf.css';
$css     = file_exists($cssPath)
    ? file_get_contents($cssPath)
    : '';
?>

<style>
    <?= $css ?>
</style>
<?php

// Cargar la vista
include __DIR__ . '/../app/Views/pdf.php';
$html = ob_get_clean();

// Configurar Dompdf
$options = new Options();
$options->set('isRemoteEnabled', true);
$pdf = new Dompdf($options);
$pdf->loadHtml($html);
$pdf->setPaper('A4', 'portrait');

if (ob_get_length()) {
    ob_end_clean();
}

$pdf->render();

// Descargar PDF
$filename = $data['nombre'] . '.pdf';
$pdf->stream($filename, ['Attachment' => true]);
exit;
