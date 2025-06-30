<?php

namespace App\Controllers;

use App\Core\Template;


class AboutController
{
    public function handle(Template $template, $pdo)
    {
        $template->apply('about');
    }
}
