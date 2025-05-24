<?php
include "libreria/principal.php";

$obra = cargarObra();
?>

<div class="row mt-5">
    <?= mostrarObra($obra) ?>
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2 class="mb-0">Personajes</h2>
            <a href="agregar_personaje.php?id=<?= $obra->codigo ?>" class="btn btn-primary">Agregar</a>
        </div>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de Nacimiento</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($obra->personajes) and count($obra->personajes) > 0) {
                    foreach ($obra->personajes as $personaje) {
                        echo "
                            <tr>
                                <td><img src='{$personaje->foto_url}' alt='{$personaje->nombre}' height='100px' class='img-fluid'></td>
                                <td>{$personaje->nombre}</td>
                                <td>{$personaje->apellido}</td>
                                <td>{$personaje->fecha_nacimiento}
                                <td>
                                    <a href='eliminar_personaje.php?id={$obra->codigo}&cedula={$personaje->cedula}' class='btn btn-danger'>Eliminar</a>
                                </td>
                            </td>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No hay personajes disponibles.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>