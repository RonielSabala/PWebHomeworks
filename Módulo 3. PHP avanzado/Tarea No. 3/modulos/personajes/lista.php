<?php
include("libreria/principal.php");
define("PAGINA_ACTUAL", "personajes");
plantilla::aplicar();

$ruta = "modulos/personajes";
?>

<h2>Personajes</h2>
<div class="text-end mb-3">
    <a href="<?= base_url($ruta . "/editar.php"); ?>" class="btn btn-success">Nuevo personaje</a>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Experiencia</th>
            <th>Profesion</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach (Dbx::list("personajes") as $personaje): ?>
            <tr>
                <td><?php echo htmlspecialchars($personaje->nombre); ?></td>
                <td><?php echo htmlspecialchars($personaje->edad) ?></td>
                <td><?php echo htmlspecialchars($personaje->nivel_experiencia); ?></td>
                <td><?php echo htmlspecialchars($personaje->profesion); ?></td>
                <td>
                    <a href="<?= base_url("{$ruta}/editar.php?idx={$personaje->idx}"); ?>" class="btn btn-warning" title="Editar">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <a href="<?= base_url("{$ruta}/eliminar.php?idx={$personaje->idx}"); ?>" class="btn btn-danger" title="Eliminar">
                        <i class="fas fa-trash-alt"></i> Eliminar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>