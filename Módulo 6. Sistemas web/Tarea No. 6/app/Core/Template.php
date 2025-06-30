<?php

namespace App\Core;


class Template
{
    public function apply(string $viewName, array $data = [])
    {
        extract($data, EXTR_SKIP);
        include __DIR__ . '/../Views/' . $viewName . '.php';
    }

    public function __construct()
    {
        $partials = __DIR__ . '/../Views/Partials/';
        include $partials . '_header.php';
        include $partials . '_nav.php';
    }

    public function __destruct()
    {
        include __DIR__ . '/../Views/Partials/_footer.php';
    }
}
