<?php

namespace App\Controllers;

use App\Core\Template;
use App\Helpers\Utils;

class EditController
{
    public function handle(Template $template, $pdo)
    {
        if ($_POST) {
            // Datos de la factura
            $id = intval($_POST['id']);
            $fecha_emision = $_POST['fecha_emision'];
            $nombre_cliente = $_POST['nombre_cliente'];
            $total = $_POST['total'];
            $comentario = $_POST['comentario'];

            $isNew = empty($id);
            if ($isNew) {
                // Crear una nueva factura
                $sql = "INSERT INTO facturas (nombre_cliente, total, comentario) VALUES (?, ?, ?)";
                $params = [$nombre_cliente, $total, $comentario];
            } else {
                // Actualizar la factura
                $sql = "UPDATE facturas SET fecha_emision = ?, nombre_cliente = ?, total = ?, comentario = ? WHERE id = ?";
                $params = [$fecha_emision, $nombre_cliente, $total, $comentario, $id];
            }

            if (!Utils::executeSql($pdo, $sql, $params)) {
                exit;
            }

            if ($isNew) {
                $id = $pdo->lastInsertId();
            } else {
                // Eliminar detalles viejos
                $sql = "DELETE FROM detalle_factura WHERE factura_id = ?";
                $params = [$id];
                if (!Utils::executeSql($pdo, $sql, $params)) {
                    exit;
                }
            }

            // Detalles de la factura
            $ids = $_POST['ids'];
            $cantidades = $_POST['cantidades'];
            $precios = $_POST['precios'];

            for ($i = 0; $i < count($ids); $i++) {
                $articulo_id = $ids[$i];
                $cantidad = $cantidades[$i];
                $precio = $precios[$i];

                // Crear detalle
                $sql = "INSERT INTO detalle_factura (factura_id, articulo_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)";
                $params = [$id, $articulo_id, $cantidad, $precio];
                if (!Utils::executeSql($pdo, $sql, $params)) {
                    exit;
                }
            }

            header('Location: /home.php');
            exit;
        }

        // Obtener el ID de la factura a editar
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $factura = Utils::getInvoiceById($pdo, $id);

            // ID invalido
            if (!$factura) {
                Utils::showAlert('Factura no encontrada!', 'danger');
                exit;
            }

            $detalles = Utils::getInvoiceDetailsById($pdo, $id);
        }

        $articulos = Utils::getAll($pdo, "articulos");
        $template->apply('edit', [
            'id' => $factura->id ?? '',
            'fecha_emision' => $factura->fecha_emision ?? '',
            'nombre_cliente' => $factura->nombre_cliente ?? '',
            'total' => $factura->total ?? 0,
            'comentario' => $factura->comentario ?? '',
            'articulos' => $articulos,
            'detalles' => isset($detalles) ? $detalles : '',
        ]);
    }
}
