<?php

require_once __DIR__ . '/db_config.php';

// Leer el script SQL
$sqlFile = __DIR__ . '/db.sql';
$sql = file_get_contents($sqlFile);

if (!$sql) {
    die("No se pudo leer el archivo SQL.");
}

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $statements = array_filter(array_map('trim', explode(';', $sql)));
    foreach ($statements as $stmt) {
        if (!empty($stmt)) {
            $pdo->exec($stmt);
        }
    }
} catch (PDOException $e) {
    die("Error de BD: " . $e->getMessage());
}
