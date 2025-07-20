<?php
const BASE_PATH = __DIR__ . '/../';
require_once BASE_PATH . '/vendor/autoload.php';
require_once BASE_PATH . '/config/db_config.php';

use App\Core\Router;


try {
    $pdo = new \PDO(
        "mysql:host=$host;dbname=$db;charset=utf8",
        $user,
        $pass
    );
} catch (\PDOException $e) {
    die("Error de BD: " . $e->getMessage());
}

$router = new Router();
$router->dispatch();
