<link rel="stylesheet" href="/css/pages/edit.css">
<div class="edit-card">
    <div class="edit-title">Personaje</div>
    <form method="post">
        <!-- Id -->
        <div class="mb-3" hidden>
            <label for="id" class="form-label">Id</label>
            <input type="number" class="form-control" id="id" name="id" value="<?= $id; ?>" readonly>
        </div>

        <!-- Nombre -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($nombre); ?>" required>
        </div>

        <!-- Color -->
        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="text" class="form-control" id="color" name="color" value="<?= htmlspecialchars($color); ?>" required>
        </div>

        <!-- Tipo -->
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" class="form-control" id="tipo" name="tipo" value="<?= htmlspecialchars($tipo); ?>" required>
        </div>

        <!-- Nivel -->
        <div class="mb-3">
            <label for="nivel" class="form-label">Nivel</label>
            <input type="number" class="form-control" id="nivel" name="nivel" value="<?= htmlspecialchars($nivel); ?>" required>
        </div>

        <!-- Foto -->
        <div class="mb-3">
            <label for="foto" class="form-label">Foto (URL)</label>
            <input type="text" class="form-control" id="foto" name="foto" value="<?= htmlspecialchars($foto); ?>" required>
        </div>

        <button type="submit" class="btn-primary">Guardar</button>
        <a href="home.php" class="btn-secondary">Cancelar</a>
    </form>
</div>