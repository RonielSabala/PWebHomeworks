<?php
include("libreria/principal.php");
define("PAGINA_ACTUAL", "profesiones");
plantilla::aplicar();

$ruta = "modulos/profesiones";
?>

<h2>Profesiones</h2>
<div class="text-end mb-3">
    <a href="<?= base_url($ruta . "/editar.php"); ?>" class="btn btn-success">Nueva profesión</a>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Salario mensual</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach (Dbx::list("profesiones") as $profesion): ?>
            <tr>
                <td><?php echo htmlspecialchars($profesion->nombre); ?></td>
                <td><?php echo htmlspecialchars($profesion->categoria); ?></td>
                <td>$RD <?php echo htmlspecialchars($profesion->salario_mensual); ?></td>
                <td>
                    <a href="<?= base_url("{$ruta}/editar.php?idx={$profesion->idx}"); ?>" class="btn btn-warning" title="Editar">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <a href="<?= base_url("{$ruta}/eliminar.php?idx={$profesion->idx}"); ?>" class="btn btn-danger" title="Eliminar">
                        <i class="fas fa-trash-alt"></i> Eliminar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>