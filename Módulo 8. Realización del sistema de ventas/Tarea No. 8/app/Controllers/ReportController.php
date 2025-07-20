<?php

namespace App\Controllers;

use PDO;
use App\Core\Template;


class ReportController
{
    static private $sqlFacturas = "SELECT
        id,
        fecha_emision,
        nombre_cliente,
        total
    FROM facturas
    WHERE DATE(fecha_emision) = CURDATE()
    ORDER BY total DESC
    ";

    static private $sqlIngresos = "SELECT
        IFNULL(SUM(total),0) AS ingresos
    FROM facturas
    WHERE DATE(fecha_emision) = CURDATE()
    ";

    public function handle(Template $template, $pdo)
    {
        // Obtener las facturas del día
        $stmt = $pdo->prepare(self::$sqlFacturas);
        $stmt->execute();
        $facturas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Obtener los ingresos del día
        $stmt2 = $pdo->prepare(self::$sqlIngresos);
        $stmt2->execute();
        $ingresos = $stmt2->fetchColumn();

        $template->apply('report', [
            "facturas" => $facturas,
            "ingresos" => $ingresos,
        ]);
    }
}
