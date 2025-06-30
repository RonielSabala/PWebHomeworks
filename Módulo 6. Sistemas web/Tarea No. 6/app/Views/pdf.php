<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
</head>
<body>
    <div class="card">
        <div class="badge">Personaje</div>
        <div class="photo-container">
            <img src="<?= $foto ?>" alt="Foto de <?= $nombre ?>" class="photo">
        </div>
        <div class="title"><?= $nombre ?></div>
        <div class="info">
            <p>
                <span class="label">Color:</span>
                <span class="value"><?= $color ?></span>
            </p>
            <p>
                <span class="label">Tipo:</span>
                <span class="value"><?= $tipo ?></span>
            </p>
            <p>
                <span class="label">Nivel:</span>
                <span class="value"><?= $nivel ?></span>
            </p>
        </div>
        <div class="description">
            <p>Rick y Morty es una comedia animada de ciencia ficción para adultos estadounidense que sigue las aventuras de Rick Sánchez, un científico cínico y alcohólico, y su nieto Morty Smith, un adolescente amable pero que se angustia fácilmente.</p>
        </div>
        <div class="features">
            <h3>Otros personajes:</h3>
            <ul>
                <?php
                $sql = "SELECT * FROM personajes";
                $stmt = $pdo->query($sql);
                $personajes = $stmt->fetchAll(PDO::FETCH_OBJ);

                foreach ($personajes as $personaje) {
                    // Excluir el personaje actual de la lista
                    if ($personaje->nombre == $nombre) {
                        continue;
                    }

                    echo "<li>{$personaje->nombre} - {$personaje->tipo}</li>";
                }
                ?>
            </ul>
        </div>
    </div>
</body>
</html>