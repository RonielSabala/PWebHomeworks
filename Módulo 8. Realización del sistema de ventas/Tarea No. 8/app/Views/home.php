<h2>Listado de facturas</h2>
<div class="d-flex justify-content-end mb-3">
    <a href="edit.php" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Crear
    </a>
</div>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Fecha de emisión</th>
            <th>Cliente</th>
            <th>Comentario</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($facturas as $factura) {
        ?>
            <tr>
                <td><?= htmlspecialchars($factura->id) ?></td>
                <td><?= htmlspecialchars($factura->fecha_emision) ?></td>
                <td><?= htmlspecialchars($factura->nombre_cliente) ?></td>
                <td><?= htmlspecialchars($factura->comentario) ?></td>
                <td><?= htmlspecialchars($factura->total) ?></td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="details.php?id=<?= $factura->id ?>" class="btn btn-outline-action btn-detail" title="Detalles">
                            <i class="bi bi-info-circle"></i>
                        </a>
                        <a href="edit.php?id=<?= $factura->id ?>" class="btn btn-outline-action btn-warning" title="Editar">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="delete.php?id=<?= $factura->id ?>" class="btn btn-outline-action btn-danger" title="Eliminar">
                            <i class="bi bi-trash"></i>
                        </a>
                        <a href="pdf.php?id=<?= $factura->id ?>" class="btn btn-outline-action btn-info" title="Descargar">
                            <i class="bi bi-file-earmark-pdf"></i>
                        </a>
                    </div>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>