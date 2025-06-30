<?php
require_once __DIR__ . '/../app/Core/Template.php';
require_once __DIR__ . '/../app/Helpers/utils.php';
require_once __DIR__ . '/../config/db_config.php';

use function App\Helpers\{modificarPersonaje, obtenerPersonajePorId};

define('CURRENT_PAGE', 'index');
$template = new \App\Core\Template();

// Obtener los datos del formulario
if ($_POST) {
    $id = intval($_POST['id']);
    $nombre = trim($_POST['nombre']);
    $color = trim($_POST['color']);
    $tipo = trim($_POST['tipo']);
    $nivel = intval($_POST['nivel']);
    $foto = trim($_POST['foto']);

    if (empty($id)) {
        // Crear un nuevo personaje
        $sql = "INSERT INTO personajes (nombre, color, tipo, nivel, foto) VALUES (?, ?, ?, ?, ?)";
        $params = [$nombre, $color, $tipo, $nivel, $foto];
    } else {
        // Actualizar el personaje
        $sql = "UPDATE personajes SET nombre = ?, color = ?, tipo = ?, nivel = ?, foto = ? WHERE id = ?";
        $params = [$nombre, $color, $tipo, $nivel, $foto, $id];
    }

    if (!modificarPersonaje($pdo, $sql, $params)) {
        exit;
    }

    $template->apply('index', [
        'pdo'   => $pdo,
    ]);

    exit;
}

$id = "";
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}

$personaje = obtenerPersonajePorId($pdo, $id);
if ($personaje === null) {
    $id = null;
}

$template->apply('edit', [
    'id'   => $id,
    'nombre' => $personaje->nombre ?? '',
    'color' => $personaje->color ?? '',
    'tipo' => $personaje->tipo ?? '',
    'nivel' => $personaje->nivel ?? 0,
    'foto' => $personaje->foto ?? '',
]);
