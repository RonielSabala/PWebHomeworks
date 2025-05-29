<?php

include("libreria/principal.php");

define("PAGINA_ACTUAL", "profesiones");
plantilla::aplicar();

$profesiones = Dbx::list("profesiones");
?>

<h1>Listado de profesiones</h1>

<div class="text-end mb-3">
    <a href="<?= base_url("modulos/profesiones/editar.php"); ?>" class="btn btn-success">Nueva Profesión</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($profesiones as $profesion): ?>
            <tr>
                <td><?php echo htmlspecialchars($profesion->nombre); ?></td>
                <td><?php echo htmlspecialchars($profesion->categoria); ?></td>
                <td>
                    <a href="<?= base_url("modulos/profesiones/editar.php?codigo={$profesion->idx}"); ?>" class="btn btn-primary">📝</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>