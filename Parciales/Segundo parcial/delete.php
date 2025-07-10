<!-- Roniel Sabala, 20240212 -->
<?php
include("app/includes.php");

Template::apply();

if (!isset($_GET["id"])) {
    showAlert("No se especificó la visita.", "danger");
    exit;
}

// Eliminar visita
$id = $_GET["id"];
$sql = "DELETE FROM visitas WHERE id = ?";
if (!modifyVisit($pdo, $sql, [$id])) {
    exit;
}

showAlert("Visita eliminada exitosamente!", "success");
