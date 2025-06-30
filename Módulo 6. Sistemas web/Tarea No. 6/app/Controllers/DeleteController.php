<?php

namespace App\Controllers;

use App\Core\Template;
use function App\Helpers\{showAlert, modifyCharacter};

class DeleteController
{
    public function handle(Template $template, $pdo)
    {
        if (!isset($_GET['id'])) {
            showAlert('No se especificó el personaje.', 'danger');
            exit;
        }

        // Confirmar si se quieren eliminar los datos
        if (!($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm']) && $_POST['confirm'] === 'yes')) {
            $template->apply('delete');
            exit;
        }

        // Eliminar personaje
        $id = intval($_GET['id']);
        $sql = "DELETE FROM personajes WHERE id = ?";
        if (!modifyCharacter($pdo, $sql, [$id])) {
            exit;
        }

        showAlert("¡Personaje eliminado exitosamente!", 'success');
    }
}
