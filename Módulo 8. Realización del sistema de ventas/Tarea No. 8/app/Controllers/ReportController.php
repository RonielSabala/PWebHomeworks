<?php

namespace App\Controllers;

use App\Core\Template;


class ReportController
{
    public function handle(Template $template, $pdo)
    {
        $template->apply('report');
    }
}
