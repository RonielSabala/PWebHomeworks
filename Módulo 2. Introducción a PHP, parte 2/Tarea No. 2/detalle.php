<?php
include "libreria/principal.php";

$obra = cargarObra();
?>

<div class="text" style="margin-top: 40px; margin-bottom: 10px;">
    <button onclick="window.print()" class="btn btn-primary">Imprimir</button>
</div>

<?= mostrarObra($obra) ?>

<div class="row">
    <div class="col-md-12">
        <h2 style="margin-top: 20px;">Personajes</h2>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Foto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Fecha de nacimiento</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Cargar los personajes
                if (isset($obra->personajes) and count($obra->personajes) > 0) {
                    foreach ($obra->personajes as $personaje) {
                        echo "<tr>";
                        echo "<td><img src='{$personaje->foto_url}' alt='{$personaje->nombre}' height='100px' class='img-fluid'></td>";
                        echo "<td>{$personaje->nombre}</td>";
                        echo "<td>{$personaje->apellido}</td>";
                        echo "<td>{$personaje->fecha_nacimiento}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No hay personajes disponibles.</td></tr>";
                }

                ?>
            </tbody>
        </table>
    </div>
</div>