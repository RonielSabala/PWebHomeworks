<div class="invoice-card">
    <div class="invoice-header">
        <h3>Datos de la factura</h3>
    </div>
    <form method="post" id="factura-form">
        <!-- Id -->
        <div class="mb-3" hidden>
            <label for="id" class="form-label">Id</label>
            <input type="number" class="form-control" id="id" name="id" value="<?= $id; ?>" readonly>
        </div>

        <!-- Fecha de emisión -->
        <div class="mb-3" <?= $fecha_emision == '' ? 'hidden' : ''; ?>>
            <label for="fecha_emision" class="form-label">Fecha de emisión</label>
            <input type="datetime-local" class="form-control" id="fecha_emision" name="fecha_emision" value="<?= $fecha_emision == '' ? date('Y-m-d H:i:s') : $fecha_emision; ?>" required>
        </div>

        <!-- Cliente -->
        <div class="mb-3">
            <label for="nombre_cliente" class="form-label">Cliente</label>
            <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" value="<?= htmlspecialchars($nombre_cliente); ?>" maxlength="50" required>
        </div>

        <!-- Tabla de artículos -->
        <table class="table mb-4">
            <thead>
                <tr>
                    <th>Artículo</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>Total</th>
                    <th style="width: 120px;">Acciones</th>
                </tr>
            </thead>
            <tbody id="items">
                <!-- Aquí van los items -->
            </tbody>
            <tfoot>
                <!-- Subtotal -->
                <tr>
                    <th colspan="3" class="text-end">Subtotal</th>
                    <td><span id="subtotal">0.00</span></td>
                </tr>

                <!-- ITBIS -->
                <tr>
                    <th colspan="3" class="text-end">ITBIS (16%)</th>
                    <td><span id="itbis">0.00</span></td>
                </tr>

                <!-- Total -->
                <tr>
                    <th colspan="3" class="text-end">Total</th>
                    <td>
                        <span id="total-label">0.00</span>
                        <input hidden name="total" id="total-input" value="0.00">
                    </td>
                </tr>
            </tfoot>
        </table>

        <!-- Comentario -->
        <div class="mb-4">
            <label for="comentario" class="form-label">Comentario</label>
            <textarea class="form-control" id="comentario" name="comentario"><?= htmlspecialchars($comentario) ?></textarea>
        </div>

        <!-- Acciones -->
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="home.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<template id="item-template">
    <tr class="item">
        <!-- Articulo -->
        <td>
            <select name="ids[]" class="form-select item-select" required>
                <option value="">N/A</option>
                <?php foreach ($articulos as $articulo): ?>
                    <option value="<?= $articulo->id ?>" data-precio="<?= $articulo->precio_unitario ?>">
                        <?= htmlspecialchars($articulo->nombre) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </td>

        <!-- Cantidad -->
        <td>
            <input type="number" name="cantidades[]" class="form-control item-cantidad" min="1" value="1" required>
        </td>

        <!-- Precio unitario -->
        <td>
            <span class="item-precio-label">0.00</span>
            <input hidden name="precios[]" class="item-precio-input">
        </td>

        <!-- Total -->
        <td>
            <span class="item-total-label">0.00</span>
        </td>

        <!-- Acciones -->
        <td>
            <button type="button" class="btn btn-success btn-sm add-row">+</button>
            <button type="button" class="btn btn-danger btn-sm delete-row">-</button>
        </td>
    </tr>
</template>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const detalles = <?= json_encode($detalles); ?>;

        if (detalles.length === 0) {
            addRow();
        } else {
            detalles.forEach(det => {
                addRow(det);
            });
        }
    });

    function addRow(detalles = null) {
        // Maximum number of rows exceeded
        const current_items = document.querySelectorAll('.item').length
        if (current_items > 0 && current_items === <?= count($articulos); ?>) {
            return;
        }

        const row = document.getElementById('item-template').content.firstElementChild.cloneNode(true);

        // Elementos
        const select = row.querySelector('.item-select');
        const cantidad = row.querySelector('.item-cantidad');
        const btnAdd = row.querySelector('.add-row');
        const btnRemove = row.querySelector('.delete-row');

        // Configurar eventos:

        // Al seleccionar otros items
        select.addEventListener('change', () => {
            updateItem(row);
            updateSelects();
        });

        // Al definir su cantidad
        cantidad.addEventListener('input', () => updateItem(row));

        // Al añadir otro item
        btnAdd.addEventListener('click', () => {
            addRow();
            updateSelects();
        });

        // Al eliminarse
        if (current_items === 0) {
            btnRemove.disabled = true;
        } else {
            btnRemove.addEventListener('click', () => {
                row.remove();
                updateTotal();
                updateSelects();
            });
        }

        // Añadir item
        document.getElementById('items').appendChild(row);

        // Rellenar valores
        if (detalles) {
            select.value = detalles.articulo_id;
            cantidad.value = detalles.cantidad;
            updateItem(row);
            updateSelects();
        }
    }

    function updateItem(row) {
        const cantidad = parseInt(row.querySelector('.item-cantidad').value) || 0;
        const precio = (parseFloat(row.querySelector('.item-select').selectedOptions[0]?.dataset.precio) || 0).toFixed(2);
        const total = (cantidad * precio).toFixed(2);

        // Actualizar datos
        row.querySelector('.item-total-label').innerText = total;
        row.querySelector('.item-precio-label').innerText = precio;
        row.querySelector('.item-precio-input').value = precio;

        updateTotal();
    }

    function updateTotal() {
        let subtotal = 0;
        document.querySelectorAll('.item-total-label').forEach(total => {
            subtotal += parseFloat(total.innerText) || 0;
        });

        const itbis = subtotal * 0.16;
        const total = (subtotal + itbis).toFixed(2);

        document.getElementById('itbis').innerText = itbis.toFixed(2);
        document.getElementById('subtotal').innerText = subtotal.toFixed(2);
        document.getElementById('total-label').innerText = total;
        document.getElementById('total-input').value = total;
    }

    function updateSelects() {
        const selects = Array.from(document.querySelectorAll('.item-select'));
        const chosen = selects.map(s => s.value).filter(v => v !== '');

        selects.forEach(s => {
            const currentValue = s.value;
            const allOptions = Array.from(s.querySelectorAll('option'));

            // Encuentra la opción en blanco
            const blank = allOptions.find(o => o.value === '');

            // Filtra para mantener solo las no usadas o la seleccionada actualmente
            const allowed = allOptions.filter(o =>
                o.value === '' ||
                o.value === currentValue ||
                (o.value !== '' && !chosen.includes(o.value))
            );

            // Reemplaza las opciones
            s.innerHTML = '';
            allowed.forEach(o => s.appendChild(o));
        });
    }
</script>