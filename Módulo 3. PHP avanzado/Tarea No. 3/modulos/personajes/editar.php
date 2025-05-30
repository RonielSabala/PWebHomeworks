<?php
include("libreria/principal.php");
$personaje = cargar_editar(Personaje::class, "personajes");

plantilla::aplicar();
?>

<h3 style="margin-bottom: 20px;">Campos del personaje</h3>
<form method="post" action="<?= $_SERVER["REQUEST_URI"] ?>">
    <div class="mb-3" hidden>
        <label for="idx" class="form-label">Código</label>
        <input type="text" class="form-control" id="idx" name="idx" value="<?= htmlspecialchars($personaje->idx); ?>" readonly>
    </div>

    <div class="mb-3">
        <label for="identificacion" class="form-label">Identificación</label>
        <input type="text" class="form-control" id="identificacion" name="identificacion" value="<?= htmlspecialchars($personaje->identificacion); ?>" required>
    </div>

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($personaje->nombre); ?>" required>
    </div>

    <div class="mb-3">
        <label for="apellido" class="form-label">Apellido</label>
        <input type="text" class="form-control" id="apellido" name="apellido" value="<?= htmlspecialchars($personaje->apellido); ?>" required>
    </div>

    <div class="mb-3">
        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= htmlspecialchars($personaje->fecha_nacimiento); ?>" required>
    </div>

    <div class="mb-3">
        <label for="foto_personaje" class="form-label">Foto del Personaje</label>
        <input type="text" class="form-control" id="foto_personaje" name="foto_personaje" value="<?= htmlspecialchars($personaje->foto_personaje); ?>" required>
    </div>

    <div class="mb-3">
        <label for="profesion_idx" class="form-label">Profesión</label>
        <select class="form-select" id="profesion_idx" name="profesion_idx" required>
            <option value="">-- Seleccione una profesión --</option>
            <?php
            $profesiones = Dbx::list("profesiones");
            foreach ($profesiones as $prof): ?>
                <option value="<?= htmlspecialchars($prof->idx); ?>" <?= $personaje->profesion_idx == $prof->idx ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($prof->nombre); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="nivel_experiencia" class="form-label">Nivel de Experiencia</label>
        <input type="number" class="form-control" id="nivel_experiencia" name="nivel_experiencia" value="<?= htmlspecialchars($personaje->nivel_experiencia); ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="<?= base_url("modulos/personajes/lista.php"); ?>" class="btn btn-secondary">Cancelar</a>
</form>