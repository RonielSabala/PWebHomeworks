<?php
include("libreria/principal.php");
$profesion = cargar_editar("profesiones", Profesion::class);

plantilla::aplicar();
?>

<h3 style="margin-bottom: 20px;">Campos de la profesión</h3>
<form method="post" action="<?= $_SERVER["REQUEST_URI"] ?>">
    <div class="mb-3" hidden>
        <label for="idx" class="form-label">Código</label>
        <input type="text" class="form-control" id="idx" name="idx" value="<?= htmlspecialchars($profesion->idx); ?>" readonly>
    </div>

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($profesion->nombre); ?>" required>
    </div>

    <div class="mb-3">
        <label for="categoria" class="form-label">Categoría</label>
        <input type="text" class="form-control" id="categoria" name="categoria" value="<?= htmlspecialchars($profesion->categoria); ?>" required>
    </div>

    <div class="mb-3">
        <label for="salario_mensual" class="form-label">Salario Mensual</label>
        <input type="number" class="form-control" id="salario_mensual" name="salario_mensual" value="<?= htmlspecialchars($profesion->salario_mensual); ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="<?= base_url("modulos/profesiones/lista.php"); ?>" class="btn btn-secondary">Cancelar</a>
</form>