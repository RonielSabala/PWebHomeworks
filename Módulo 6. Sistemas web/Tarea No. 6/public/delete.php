<?php
require_once __DIR__ . '/../app/Core/Template.php';
require_once __DIR__ . '/../app/Helpers/utils.php';
require_once __DIR__ . '/../config/db_config.php';

use function App\Helpers\{showAlert, modificarPersonaje};

define('CURRENT_PAGE', 'index');
$template = new \App\Core\Template();

if (!isset($_GET['id'])) {
    showAlert('No se especificó el personaje.', 'danger');
    exit;
}

if (!($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm']) && $_POST['confirm'] === 'yes')) {
    $template->apply('delete');
    exit;
}

// Eliminar personaje
$id = intval($_GET['id']);
$sql = "DELETE FROM personajes WHERE id = ?";
if (!modificarPersonaje($pdo, $sql, [$id])) {
    exit;
}

showAlert("¡Personaje eliminado exitosamente!", 'success');
