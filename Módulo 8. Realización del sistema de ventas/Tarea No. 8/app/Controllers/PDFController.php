<?php

namespace App\Controllers;

use App\Core\Template;
use App\Helpers\Utils;

class PdfController
{
    public function handle(Template $template, $pdo)
    {
        $data = Utils::getAllInvoiceDetails($pdo);
    }
}
