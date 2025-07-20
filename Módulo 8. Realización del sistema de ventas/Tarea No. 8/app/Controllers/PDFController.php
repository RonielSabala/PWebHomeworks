<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Core\Template;
use App\Helpers\Utils;

class PdfController
{
    public function handle(Template $template, $pdo)
    {
        self::downloadPDF($pdo);
    }

    public static function downloadPDF($pdo)
    {
        $data = Utils::getAllInvoiceDetails($pdo);

        // Iniciar el buffer y cargar la vista como php
        ob_start();
        extract($data, EXTR_SKIP);

        // Cargar el CSS
        $cssPath = __DIR__ . '/../../public/css/pages/details.css';
        $css = file_exists($cssPath) ? file_get_contents($cssPath) : '';
?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
        <style>
            <?= $css ?>
        </style>
<?php

        // Cargar la vista
        include __DIR__ . '/../Views/details.php';
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
        $filename = 'Factura de ' . $data['nombre_cliente'] . '.pdf';
        $pdf->stream($filename, ['Attachment' => true]);
        exit;
    }
}
