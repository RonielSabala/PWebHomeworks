<?php

namespace App\Controllers;

use App\Core\Template;
use App\Helpers\Utils;


class HomeController
{
    public function handle(Template $template, $pdo)
    {
        $template->apply('home', [
            'facturas' => Utils::getAll($pdo, "facturas"),
        ]);
    }
}
