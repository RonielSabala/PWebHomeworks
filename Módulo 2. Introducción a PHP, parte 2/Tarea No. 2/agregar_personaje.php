<?php
include "libreria/principal.php";

$obra = cargarObra();
$personaje = new Personaje();
$ruta_personajes = "personajes.php?id=$obra->codigo";
if ($_POST) {
    $personaje->cedula = $_POST['cedula'];
    $personaje->foto_url = $_POST['foto_url'];
    $personaje->nombre = $_POST['nombre'];
    $personaje->apellido = $_POST['apellido'];
    $personaje->fecha_nacimiento = $_POST['fecha_nacimiento'];
    $personaje->sexo = $_POST['sexo'];
    $personaje->habilidades = $_POST['habilidades'];
    $personaje->comida_favorita = $_POST['comida_favorita'];

    if (!isset($obra->personajes)) {
        $obra->personajes = [];
    }

    $obra->personajes[] = $personaje;
    guardarObra($obra, "Personaje guardado exitosamente.", $ruta_personajes);
    exit;
}
?>

<!-- Resumen de la obra -->
<div class="row mt-5">
    <?= mostrarObra($obra) ?>
    <div class="col-md-8">
        <h2>Datos del personaje</h2>
        <form action="agregar_personaje.php?id=<?= $obra->codigo ?>" method="post" enctype="multipart/form-data">
            <!-- Cédula -->
            <div class="mb-3">
                <label for="cedula" class="form-label">Cédula</label>
                <input type="text" class="form-control" id="cedula" name="cedula" value="<?= $personaje->cedula ?>" required>
            </div>

            <!-- Foto -->
            <div class="mb-3">
                <label for="foto_url" class="form-label">Foto</label>
                <input type="text" class="form-control" id="foto_url" name="foto_url" value="<?= $personaje->foto_url ?>" required>
            </div>

            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" accept=".jpg, .jpeg, .png, .gif" value="<?= $personaje->nombre ?>" required>
            </div>

            <!-- Apellido -->
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?= $personaje->apellido ?>" required>
            </div>

            <!-- Fecha de nacimiento -->
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= $personaje->fecha_nacimiento ?>" required>
            </div>

            <!-- Sexo -->
            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <select class="form-select" id="sexo" name="sexo" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="masculino" <?= $personaje->sexo == "masculino" ? "selected" : "" ?>>Masculino</option>
                    <option value="femenino" <?= $personaje->sexo == "femenino" ? "selected" : "" ?>>Femenino</option>
                </select>
            </div>

            <!-- Habilidades -->
            <div class="mb-3">
                <label for="habilidades" class="form-label">Habilidades</label>
                <textarea class="form-control" id="habilidades" name="habilidades" rows="3" required><?= $personaje->habilidades ?></textarea>
            </div>

            <!-- Comida favorita -->
            <div class="mb-3">
                <label for="comida_favorita" class="form-label">Comida favorita</label>
                <input type="text" class="form-control" id="comida_favorita" name="comida_favorita" value="<?= $personaje->comida_favorita ?>" required>
            </div>

            <div class="text-center mb-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?= $ruta_personajes ?>" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</div>