<?php

namespace App\Controllers;

use App\Core\Template;

class HomeController
{
    public function handle(Template $template, $pdo)
    {
        $template->apply('home', [
            'pdo'   => $pdo,
        ]);
    }
}
