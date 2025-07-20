<div class="invoice-container">
    <div class="header">
        <h1>La Rubia</h1>
        <div class="meta">Factura No. <?= htmlspecialchars($id) ?> | Emitida: <?= htmlspecialchars($fecha_emision) ?></div>
        <div class="meta">Cliente: <?= htmlspecialchars($nombre_cliente) ?></div>
    </div>

    <div class="details">
        <table>
            <thead>
                <tr>
                    <th>Artículo</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detalles as $d): ?>
                    <tr>
                        <td><?= htmlspecialchars($d['nombre']) ?></td>
                        <td><?= intval($d['cantidad']) ?></td>
                        <td><?= number_format((float)$d['precio_unitario'], 2) ?> €</td>
                        <td><?= number_format($d['cantidad'] * (float)$d['precio_unitario'], 2) ?> €</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="totals">
        <div><span class="label">Subtotal:</span><span class="value"><?= number_format((float)$total - (float)$total * 0.16, 2) ?> €</span></div>
        <div><span class="label">ITBIS (16%):</span><span class="value"><?= number_format((float)$total * 0.16, 2) ?> €</span></div>
        <div class="total"><span class="label">Total:</span><span class="value"><?= number_format((float)$total, 2) ?> €</span></div>
    </div>

    <?php if (!empty($comentario)): ?>
        <div class="comentario">
            <p>Comentario: <?= nl2br(htmlspecialchars($comentario)) ?></p>
        </div>
    <?php endif; ?>

    <div class="actions">
        <a href="home.php" class="btn btn-success">Volver</a>
    </div>
</div>