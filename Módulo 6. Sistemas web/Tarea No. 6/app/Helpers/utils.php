<?php

namespace App\Helpers;

use PDO;
use PDOException;


function getActiveClass(string $page): string
{
    $current = defined('CURRENT_PAGE') ? CURRENT_PAGE : '';
    return 'custom-link nav-link' . ($current === $page ? ' active' : '');
}

function showAlert(string $message, string $type = 'success', string $returnRoute = 'home.php'): void
{
    echo "
    <div class='text-center'>
        <div class='alert alert-$type'>$message</div>
        <a href='$returnRoute' class='btn btn-primary'>Volver</a>
    </div>
    ";
}

function modifyCharacter($pdo, $sql, $params)
{
    try {
        // Ejecutar consulta
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return true;
    } catch (PDOException $e) {
        showAlert($e->getMessage(), 'danger');
        return false;
    }
}

function getCharacterById($pdo, $id)
{
    $sql = "SELECT * FROM personajes WHERE id = ?";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        showAlert($e->getMessage(), 'danger');
        return null;
    }
}
