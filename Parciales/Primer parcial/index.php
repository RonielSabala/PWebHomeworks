<!-- Roniel Sabala, 20240212 -->
<?php
include("libreria/principal.php");
Plantilla::aplicar();
?>

<h2>Citas</h2>
<div class="text-end">
    <a href="editar.php" class="btn btn-success">Agregar cita</a>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Fecha de la visita</th>
            <th>Motivo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (is_dir("datos")) {
            $archivos = scandir("datos");
            foreach ($archivos as $archivo) {
                $ruta = "datos/" . $archivo;
                if (is_file($ruta)) {
                    $json = file_get_contents($ruta);
                    $cita = json_decode($json);
        ?>
                    <tr>
                        <td><?= $cita->nombre . " " . $cita->apellido; ?></td>
                        <td><?= $cita->fecha; ?></td>
                        <td><?= $cita->motivo; ?></td>
                        <td>
                            <a href="editar.php?idx=<?= $cita->idx; ?>" class="btn btn-warning"><i class="fas fa-edit">Editar</i></a>
                            <a href="eliminar.php?idx=<?= $cita->idx; ?>" class="btn btn-danger"><i class="fas fa-trash">Eliminar</i></a>
                        </td>
                    </tr>
        <?php
                }
            }
        }
        ?>
    </tbody>
</table>