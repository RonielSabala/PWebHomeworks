<!-- Roniel Sabala, 20240212 -->
<?php
include("app/Template.php");
include("app/db_config.php");

function showAlert(string $message, string $type): void
{
    echo "
        <div class='text-center'>
            <div class='alert alert-$type'>$message</div>
            <a href='index.php' class='btn btn-primary'>Volver</a>
        </div>
    ";
}

function getVisitById($pdo, $id)
{
    $sql = "SELECT * FROM visitas WHERE id = ?";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        showAlert($e->getMessage(), "danger");
    }
}

function modifyVisit($pdo, $sql, $params): bool
{
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return true;
    } catch (PDOException $e) {
        showAlert($e->getMessage(), "danger");
        return false;
    }
}
