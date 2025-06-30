<?php
require_once __DIR__ . '/../config/db_config.php';
require_once __DIR__ . '/../app/Core/Router.php';
require_once __DIR__ . '/../app/Core/Template.php';
require_once __DIR__ . '/../app/Helpers/utils.php';
require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/AboutController.php';
require_once __DIR__ . '/../app/Controllers/EditController.php';
require_once __DIR__ . '/../app/Controllers/DeleteController.php';
require_once __DIR__ . '/../app/Controllers/PdfController.php';

use App\Core\Router;


$router = new Router();
$router->dispatch();
