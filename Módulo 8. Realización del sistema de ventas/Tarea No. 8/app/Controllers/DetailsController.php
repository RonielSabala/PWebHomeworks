<?php

namespace App\Controllers;

use App\Core\Template;
use App\Helpers\Utils;


class DetailsController
{
    public function handle(Template $template, $pdo)
    {
        $template->apply('details', Utils::getAllInvoiceDetails($pdo));
    }
}
