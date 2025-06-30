<?php
require_once __DIR__ . '/../app/Core/Template.php';
require_once __DIR__ . '/../app/Helpers/utils.php';
require_once __DIR__ . '/../config/db_config.php';

define('CURRENT_PAGE', 'index');
$template = new \App\Core\Template();
$template->apply('index', [
    'pdo'   => $pdo,
]);
