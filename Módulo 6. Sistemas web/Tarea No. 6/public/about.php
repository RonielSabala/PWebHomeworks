<?php
require_once __DIR__ . '/../app/Core/Template.php';
require_once __DIR__ . '/../app/Helpers/utils.php';

define('CURRENT_PAGE', 'about');
$template = new \App\Core\Template();
$template->apply('about');
