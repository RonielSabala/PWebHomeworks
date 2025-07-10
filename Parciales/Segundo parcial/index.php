<!-- Roniel Sabala, 20240212 -->
<?php
include("app/includes.php");

Template::apply();
?>

<h2>Listado de visitas</h2>
<div class="text-end mt-3">
    <a href="edit.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Agregar</a>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Correo electrónico</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM visitas";
        $stmt = $pdo->query($sql);
        $visitas = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach ($visitas as $visita) {
        ?>
            <tr>
                <td><?= htmlspecialchars($visita->nombre) ?></td>
                <td><?= htmlspecialchars($visita->apellido) ?></td>
                <td><?= htmlspecialchars($visita->telefono) ?></td>
                <td><?= htmlspecialchars($visita->correo) ?></td>
                <td>
                    <a href="edit.php?id=<?= $visita->id ?>" class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i> Editar
                    </a>
                    <a href="delete.php?id=<?= $visita->id ?>" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Eliminar
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>