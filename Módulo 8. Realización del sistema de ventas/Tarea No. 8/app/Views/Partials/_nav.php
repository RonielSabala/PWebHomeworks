<?php

use App\Helpers\Utils;
?>

<div class="divMenu">
    <ul class="nav nav-tabs d-flex align-items-center">
        <li class="nav-item">
            <a class="<?= Utils::getActiveClass('home') ?>"
                href="/home.php">Facturas</a>
        </li>
        <li class="nav-item">
            <a class="<?= Utils::getActiveClass('report') ?>"
                href="/report.php">Reporte</a>
        </li>
        <li class="nav-item ms-auto">
            <a
                href="/login.php?logout=true"
                class="btn btn-outline-danger btn-sm">
                Cerrar sesión
            </a>
        </li>
    </ul>
</div>
<div class="view-content">
    <!-- View content here -->