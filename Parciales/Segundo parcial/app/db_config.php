<!-- Roniel Sabala, 20240212 -->
<?php

// Datos de conexión
$host = "127.0.0.1";
$user = "dummy";
$pass = "";
$db = "visitas_db";

$pdo = new PDO(
    "mysql:host=$host;dbname=$db",
    $user,
    $pass
);
