<?php

use App\Helpers\Utils;
?>

<div class="divMenu">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="<?= Utils::getActiveClass('home') ?>"
                href="/home.php">Facturas</a>
        </li>
        <li class="nav-item">
            <a class="<?= Utils::getActiveClass('report') ?>"
                href="/report.php">Reporte</a>
        </li>
    </ul>
</div>
<div class="view-content">
    <!-- View content here -->