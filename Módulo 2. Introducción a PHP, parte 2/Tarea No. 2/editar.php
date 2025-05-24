<?php
include "libreria/principal.php";

$obra = new Obra();

if (isset($_GET['id'])) {
    $ruta = "datos/" . $_GET['id'] . ".json";
    if (file_exists($ruta)) {
        $json = file_get_contents($ruta);
        $obra = json_decode($json);
    }
}

if ($_POST) {
    $obra->codigo = $_POST['codigo'];
    $obra->foto_url = $_POST['foto_url'];
    $obra->tipo = $_POST['tipo'];
    $obra->nombre = $_POST['nombre'];
    $obra->descripcion = $_POST['descripcion'];
    $obra->pais = $_POST['pais'];
    $obra->autor = $_POST['autor'];

    if (!is_dir("datos")) {
        mkdir("datos");
    }

    if (!is_dir("datos")) {
        plantilla::aplicar();
        echo "<div class='alert alert-danger'>Error: No se pudo crear el directorio 'datos'.</div>";
        echo "<a href='index.php' class='btn btn-primary'>Volver a la lista</a>";
        exit;
    }

    $ruta = "datos/" . $obra->codigo . ".json";
    $json = json_encode($obra);

    file_put_contents($ruta, $json);

    plantilla::aplicar();
    echo "<div class='alert alert-success'>Obra guardada correctamente.</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver a la lista</a>";
    exit;
}

plantilla::aplicar();
?>

<form method="post" action="editar.php">
    <!-- Código de la obra -->
    <div class="mb-3">
        <label for="codigo" class="form-label">Código</label>
        <input type="text" name="codigo" id="codigo" class="form-control" value="<?php echo $obra->codigo; ?>" required>
    </div>

    <!-- Foto de la obra -->
    <div class="mb-3">
        <label for="foto_url" class="form-label">Foto de la obra</label>
        <input type="text" name="foto_url" id="foto_url" class="form-control" value="<?php echo $obra->foto_url; ?>" required>
    </div>

    <!-- Tipo de obra -->
    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo</label>
        <select name="tipo" id="tipo" class="form-select">
            <option value="">Seleccione</option>
            <?php
            $selected = $obra->tipo;
            foreach (Datos::Tipos_de_Obra() as $key => $value) {
                $isSelected = ($key == $selected) ? "selected" : "";
                echo "<option value='$key' $isSelected>$value</option>";
            }
            ?>
        </select>
    </div>

    <!-- Nombre de la obra -->
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $obra->nombre; ?>" required>
    </div>

    <!-- Descripción de la obra -->
    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required><?php echo $obra->descripcion; ?></textarea>
    </div>

    <!-- País de la obra -->
    <div class="mb-3">
        <label for="pais" class="form-label">País</label>
        <input type="text" name="pais" id="pais" class="form-control" value="<?php echo $obra->pais; ?>" required>
    </div>

    <!-- Autor de la obra -->
    <div class="mb-3">
        <label for="autor" class="form-label">Autor</label>
        <input type="text" name="autor" id="autor" class="form-control" value="<?php echo $obra->autor; ?>" required>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>