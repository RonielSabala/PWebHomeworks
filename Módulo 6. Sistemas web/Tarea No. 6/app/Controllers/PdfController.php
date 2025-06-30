<?php

namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';


use Dompdf\Dompdf;
use Dompdf\Options;
use App\Core\Template;
use function App\Helpers\{showAlert, getCharacterById};

class PdfController
{
    public function handle(Template $template, $pdo)
    {
        if (!isset($_GET['id'])) {
            showAlert('No se especificó el personaje.', 'danger');
            exit;
        }

        $id = intval($_GET['id']);
        $character = getCharacterById($pdo, $id);
        if ($character === null) {
            showAlert('Personaje no encontrado.', 'danger');
            exit;
        }

        // Data de la vista
        $data = [
            'nombre' => htmlspecialchars($character->nombre, ENT_QUOTES, 'UTF-8'),
            'color'  => htmlspecialchars($character->color,  ENT_QUOTES, 'UTF-8'),
            'tipo'   => htmlspecialchars($character->tipo,   ENT_QUOTES, 'UTF-8'),
            'nivel'  => htmlspecialchars($character->nivel,  ENT_QUOTES, 'UTF-8'),
            'foto'   => htmlspecialchars($character->foto,   ENT_QUOTES, 'UTF-8'),
        ];

        // Iniciar el buffer y cargar la vista como PHP
        ob_start();
        extract($data, EXTR_SKIP);

        // Cargar el CSS
        $cssPath = __DIR__ . '/../../public/css/pages/pdf.css';
        $css     = file_exists($cssPath)
            ? file_get_contents($cssPath)
            : '';
?>
        <style>
            <?= $css ?>
        </style>
<?php

        // Cargar la vista
        include __DIR__ . '/../Views/pdf.php';
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
    }
}
