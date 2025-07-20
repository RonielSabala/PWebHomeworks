<?php

namespace App\Controllers;

use App\Core\Template;
use App\Helpers\Utils;


class DeleteController
{
    public function handle(Template $template, $pdo)
    {
        if (!isset($_GET['id'])) {
            Utils::showAlert('No se especificó la factura.', 'danger');
            exit;
        }

        // Confirmar si se quieren eliminar los datos
        if (!($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm']) && $_POST['confirm'] === 'yes')) {
            $template->apply('delete');
            exit;
        }

        // Eliminar factura
        $id = intval($_GET['id']);
        $sql = "DELETE FROM facturas WHERE id = ?";
        if (!Utils::executeSql($pdo, $sql, [$id])) {
            exit;
        }

        Utils::showAlert("¡Factura eliminada exitosamente!", 'success');
    }
}
