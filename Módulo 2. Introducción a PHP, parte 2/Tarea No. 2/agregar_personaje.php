<?php
include "libreria/principal.php";

$obra = new Obra();
$personaje = new Personaje();

if (isset($_GET['id'])) {
    $ruta = "datos/" . $_GET['id'] . ".json";
    if (file_exists($ruta)) {
        $json = file_get_contents($ruta);
        $obra = json_decode($json);
    } else {
        plantilla::aplicar();
        echo "<div class='text-center'><div class='alert alert-danger'>Error al cargar la obra</div>";
        echo "<a href='index.php' class='btn btn-primary'>Volver</a></div>";
        exit();
    }
} else {
    plantilla::aplicar();
    echo "<div class='text-center'><div class='alert alert-danger'>Error al cargar la obra</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver</a></div>";
    exit();
}

plantilla::aplicar();

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
    if (!is_dir("datos")) {
        echo "<div class='text-center'><div class='alert alert-danger'>Error al crear la carpeta de datos</div>";
        echo "<a href='index.php' class='btn btn-primary'>Volver</a></div>";
        exit();
    }

    $ruta = "datos/" . $obra->codigo . ".json";
    file_put_contents($ruta, json_encode($obra));

    echo "<div class='text-center'><div class='alert alert-success'>Personaje guardado exitosamente</div>";
    echo "<a href='personajes.php?id=" . $obra->codigo . "' class='btn btn-primary'>Volver</a></div>";
    exit();
}
?>

<!-- Resumen de la obra -->
<div class="row">
    <div class="col-md-4">
        <h2><?= $obra->nombre; ?></h2>
        <img src="<?= $obra->foto_url ?>" alt="<?= $obra->nombre ?>" height="200px" class="img-fluid">
        <p><strong>Tipo:</strong> <?= Datos::Tipos_de_Obra()[$obra->tipo] ?></p>
        <p><strong>Autor:</strong> <?= $obra->autor ?></p>
        <p><strong>País:</strong> <?= $obra->pais ?></p>
        <p><strong>Descripción:</strong> <?= $obra->descripcion ?></p>
    </div>
    <div class="col-md-8">
        <h2>Datos del personaje</h2>
        <form action="agregar_personaje.php?id=<?= $obra->codigo ?>" method="post" enctype="multipart/form-data">
            <!-- cedula del personaje -->
            <div class="mb-3">
                <label for="cedula" class="form-label">Cédula</label>
                <input type="text" class="form-control" id="cedula" name="cedula" value="<?= $personaje->cedula ?>" required>
            </div>
            <!-- foto del personaje -->
            <div class="mb-3">
                <label for="foto_url" class="form-label">Foto</label>
                <input type="text" class="form-control" id="foto_url" name="foto_url" value="<?= $personaje->foto_url ?>" required>
            </div>
            <!-- nombre del personaje -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" accept=".jpg, .jpeg, .png, .gif" value="<?= $personaje->nombre ?>" required>
            </div>
            <!-- apellido del personaje -->
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?= $personaje->apellido ?>" required>
            </div>
            <!-- fecha de nacimiento del personaje -->
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= $personaje->fecha_nacimiento ?>" required>
            </div>
            <!-- sexo del personaje -->
            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <select class="form-select" id="sexo" name="sexo" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="masculino" <?= $personaje->sexo == "masculino" ? "selected" : "" ?>>Masculino</option>
                    <option value="femenino" <?= $personaje->sexo == "femenino" ? "selected" : "" ?>>Femenino</option>
                </select>
            </div>
            <!-- habilidades del personaje -->
            <div class="mb-3">
                <label for="habilidades" class="form-label">Habilidades</label>
                <textarea class="form-control" id="habilidades" name="habilidades" rows="3" required><?= $personaje->habilidades ?></textarea>
            </div>
            <!-- comida favorita del personaje -->
            <div class="mb-3">
                <label for="comida_favorita" class="form-label">Comida favorita</label>
                <input type="text" class="form-control" id="comida_favorita" name="comida_favorita" value="<?= $personaje->comida_favorita ?>" required>
            </div>

            <div class="text-center mb-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="personajes.php?id=<?= $obra->codigo ?>" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</div>