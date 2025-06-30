<link rel="stylesheet" href="/css/pages/home.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap">
<h2>Listado de personajes</h2>
<div class="text-end mb-3">
    <a href="edit.php" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Agregar
    </a>
</div>
<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Color</th>
            <th>Tipo</th>
            <th>Nivel</th>
            <th>Foto</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM personajes";
        $stmt = $pdo->query($sql);
        $personajes = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach ($personajes as $personaje) {
        ?>
            <tr>
                <td style="font-family: 'Luckiest Guy', cursive; color: #444;"><?= htmlspecialchars($personaje->nombre) ?></td>
                <td><?= htmlspecialchars($personaje->color) ?></td>
                <td><?= htmlspecialchars($personaje->tipo) ?></td>
                <td><?= htmlspecialchars($personaje->nivel) ?></td>
                <td>
                    <img src="<?= htmlspecialchars($personaje->foto) ?>" alt="Foto de <?= htmlspecialchars($personaje->nombre) ?>">
                </td>
                <td>
                    <div class="actions-btn-group">
                        <a href="edit.php?id=<?= $personaje->id ?>" class="btn btn-outline-action btn-warning">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                        <a href="delete.php?id=<?= $personaje->id ?>" class="btn btn-outline-action btn-danger">
                            <i class="bi bi-trash"></i> Eliminar
                        </a>
                        <a href="pdf.php?id=<?= $personaje->id ?>" class="btn btn-outline-action btn-info">
                            <i class="bi bi-file-earmark-pdf"></i> Descargar PDF
                        </a>
                    </div>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>