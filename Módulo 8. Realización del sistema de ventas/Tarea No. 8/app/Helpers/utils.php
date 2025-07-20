<?php

namespace App\Helpers;

use PDO;
use PDOException;


class Utils
{
    static private $invoiceSql = "SELECT * FROM facturas WHERE id = ?";
    static private $invoiceDetailsSql = "SELECT
        df.articulo_id,
        a.nombre,
        df.cantidad,
        df.precio_unitario
    FROM detalle_factura df
    JOIN articulos a ON df.articulo_id = a.id
    WHERE df.factura_id = ?
    ";

    public static function getActiveClass(string $page): string
    {
        $current = defined('CURRENT_PAGE') ? CURRENT_PAGE : '';
        return 'custom-link nav-link' . ($current === $page ? ' active' : '');
    }

    public static function showAlert(string $message, string $type = 'success', string $returnRoute = 'home.php'): void
    {
        echo "
        <div class='text-center'>
            <div class='alert alert-$type'>$message</div>
            <a href='$returnRoute' class='btn btn-primary'>Volver</a>
        </div>
        ";
    }
    public static function executeSql($pdo, $sql, $params)
    {
        try {
            // Ejecutar consulta
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            return true;
        } catch (PDOException $e) {
            self::showAlert($e->getMessage(), 'danger');
            return false;
        }
    }

    public static function getInvoiceById($pdo, $id)
    {
        try {
            $stmt = $pdo->prepare(self::$invoiceSql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            self::showAlert($e->getMessage(), 'danger');
            return null;
        }
    }

    public static function getInvoiceDetailsById($pdo, $id)
    {
        try {
            $stmt = $pdo->prepare(self::$invoiceDetailsSql);
            $stmt->execute([$id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            self::showAlert($e->getMessage(), 'danger');
            return null;
        }
    }

    public static function getAll($pdo, $table)
    {
        $sql = "SELECT * FROM " . $table;
        try {
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            self::showAlert($e->getMessage(), 'danger');
            return null;
        }
    }

    public static function getAllInvoiceDetails($pdo)
    {
        if (!isset($_GET['id'])) {
            Utils::showAlert('No se especificó la factura.', 'danger');
            exit;
        }

        $id = intval($_GET['id']);
        $factura = Utils::getInvoiceById($pdo, $id);

        // ID invalido
        if (!$factura) {
            Utils::showAlert('Factura no encontrada!', 'danger');
            exit;
        }

        return [
            'id' => $factura->id,
            'fecha_emision' => $factura->fecha_emision,
            'nombre_cliente' => $factura->nombre_cliente,
            'total' => $factura->total,
            'comentario' => $factura->comentario,
            'detalles' => Utils::getInvoiceDetailsById($pdo, $id),
        ];
    }
}
