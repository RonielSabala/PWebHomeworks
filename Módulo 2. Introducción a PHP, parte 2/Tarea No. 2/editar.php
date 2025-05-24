<?php
include "libreria/principal.php";

$obra = cargarObra(False);
if ($_POST) {
    $obra->codigo = $_POST['codigo'];
    $obra->foto_url = $_POST['foto_url'];
    $obra->tipo = $_POST['tipo'];
    $obra->nombre = $_POST['nombre'];
    $obra->descripcion = $_POST['descripcion'];
    $obra->pais = $_POST['pais'];
    $obra->autor = $_POST['autor'];

    guardarObra($obra, "Obra guardada exitosamente.", "index.php");
    exit();
}
?>

<form method="post" action="editar.php">
    <h2 style="margin-top: 30px">Datos de la obra</h2>

    <!-- Código -->
    <div class="mb-3">
        <label for="codigo" class="form-label">Código</label>
        <input type="text" name="codigo" id="codigo" class="form-control" value="<?php echo $obra->codigo; ?>" required>
    </div>

    <!-- Foto -->
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
            foreach ($tipos_de_obra as $key => $value) {
                $isSelected = ($key == $selected) ? "selected" : "";
                echo "<option value='$key' $isSelected>$value</option>";
            }
            ?>
        </select>
    </div>

    <!-- Nombre -->
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $obra->nombre; ?>" required>
    </div>

    <!-- Descripción -->
    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required><?php echo $obra->descripcion; ?></textarea>
    </div>

    <!-- País -->
    <div class="mb-3">
        <label for="pais" class="form-label">País</label>
        <input type="text" name="pais" id="pais" class="form-control" value="<?php echo $obra->pais; ?>" required>
    </div>

    <!-- Autor -->
    <div class="mb-3">
        <label for="autor" class="form-label">Autor</label>
        <input type="text" name="autor" id="autor" class="form-control" value="<?php echo $obra->autor; ?>" required>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>