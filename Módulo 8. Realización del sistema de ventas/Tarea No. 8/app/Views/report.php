<div class="report-container">
    <div class="report-header">
        <h2>Reporte del día</h2>
        <div class="date">Fecha: <?= (empty($facturas)) ? date('d/m/y') : date('d/m/y', strtotime($facturas[0]['fecha_emision'])) ?></div>
    </div>
    <div class="report-body">
        <?php if (count($facturas) === 0): ?>
            <div class="empty">No hay facturas registradas hoy.</div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hora</th>
                        <th>Cliente</th>
                        <th>Total ($RD)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($facturas as $f): ?>
                        <tr>
                            <td><?= $f['id'] ?></td>
                            <td><?= date('H:i:s', strtotime($f['fecha_emision'])) ?></td>
                            <td><?= htmlspecialchars($f['nombre_cliente']) ?></td>
                            <td><?= number_format($f['total'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <div class="report-footer">
        <div class="label">Total ingresos hoy:</div>
        <div class="value"><?= number_format($ingresos, 2) ?> $RD</div>
    </div>
</div>