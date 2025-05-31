<?php
include("libreria/principal.php");
define("PAGINA_ACTUAL", "estadisticas");

// Colecciones
$personajes = Dbx::list("personajes");
$profesiones = Dbx::list("profesiones");
$n_personajes = count($personajes);
$n_profesiones = count($profesiones);

// Variables para almacenar estadísticas
$datos = [];
$labels = [];
$exp_total = 0;
$edad_total = 0;
$salario_total = 0;
$salario_min = null;
$salario_max = null;
$prof_distribution = [];
$nombre_persona_mas_pagada = "";
$salario_persona_mas_pagada = 0;

foreach ($profesiones as $profesion) {
    $labels[] = $profesion->nombre;
    $datos[] = $profesion->salario_mensual;
    $salario_total += $profesion->salario_mensual;

    if ($salario_min === null || $salario_min->salario_mensual < $profesion->salario_mensual) {
        $salario_min = $profesion;
    }

    if ($salario_max === null || $salario_max->salario_mensual > $profesion->salario_mensual) {
        $salario_max = $profesion;
    }

    if (!isset($prof_distribution[$profesion->idx])) {
        $prof_distribution[$profesion->idx] = [
            "nombre" => $profesion->nombre,
            "cantidad" => 0
        ];
    }
}

foreach ($personajes as $personaje) {
    $edad_total += $personaje->edad;
    $exp_total += $personaje->nivel_experiencia;

    if (isset($prof_distribution[$personaje->profesion_idx])) {
        $prof_distribution[$personaje->profesion_idx]['cantidad']++;
    }

    $salario = $personaje->salario_mensual;
    if ($salario_persona_mas_pagada < $salario) {
        $salario_persona_mas_pagada = $salario;
        $nombre_persona_mas_pagada = $personaje->nombre;
    }
}

plantilla::aplicar();
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<h2 class="text-center mb-5">Estadísticas del Mundo Barbie</h2>
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary h-100">
            <div class="card-body">
                <h5 class="card-title"> <i class="fa fa-users"></i> Personajes</h5>
                <p class="card-text fs-4"><?= $n_personajes; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-secondary h-100">
            <div class="card-body">
                <h5 class="card-title"> <i class="fa fa-briefcase"></i> Profesiones</h5>
                <p class="card-text fs-4"> <?= $n_profesiones; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success h-100">
            <div class="card-body">
                <h5 class="card-title"> <i class="fa fa-heartbeat"></i> Edad Promedio</h5>
                <p class="card-text fs-4"> <?= obtener_promedio($edad_total, $n_personajes, 0); ?> años</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning h-100">
            <div class="card-body">
                <h5 class="card-title"> <i class="fa fa-star"></i> Nivel de experiencia común</h5>
                <p class="card-text fs-4"> <?= obtener_promedio($exp_total, $n_personajes); ?></p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Distribución de personajes por categoria</h5>
                <ul class="list-group">
                    <?php
                    foreach ($prof_distribution as $profesion) {
                        $cantidad = $profesion['cantidad'];
                        $texto = ($cantidad === 1) ? "personaje" : "personajes";
                        echo "<li class='list-group-item'>{$profesion['nombre']}: {$cantidad} {$texto}</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Salarios destacados</h5>
                <p><strong>Profesión con mayor salario:</strong> <?= $salario_min; ?></p>
                <p><strong>Profesión con menor salario:</strong> <?= $salario_max; ?></p>
                <p><strong>Salario promedio:</strong> <?= ($promedio = obtener_promedio($salario_total, $n_profesiones)) ? "$" . "RD " . $promedio : ""; ?></p>
                <p><strong>Personaje con mayor salario:</strong> <?= $nombre_persona_mas_pagada && $salario_persona_mas_pagada ? $nombre_persona_mas_pagada . " (" . "$" . "RD " . $salario_persona_mas_pagada . ")" : ""; ?></p>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h4 class="card-title text-center">Distribución de salarios por categoría de profesión.</h4>
        <canvas id="salaryChart" height="100"></canvas>
    </div>
</div>

<script>
    const ctx = document.getElementById('salaryChart').getContext('2d');
    const salaryChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($labels); ?>,
            datasets: [{
                label: 'Salario Promedio ($RD)',
                data: <?= json_encode($datos); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ],
                borderColor: '#fff',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => "$RD" + value.toLocaleString()
                    }
                }
            }
        }
    });
</script>