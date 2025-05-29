<?php

include("libreria/principal.php");

define("PAGINA_ACTUAL", "estadisticas");

$personajes = Dbx::list("personajes");
$profesiones = Dbx::list("profesiones");

$edad_total = 0;
$excom = 0;

$salario_graph = [];

$mayor_salario = null;
$menor_salario = null;
$salario_prom = 0;
$per_mayor_salario = [
    "nombre" => null,
    "salario" => 0,
];

$personasXprofesion = [];
foreach ($profesiones as $profesion) {
    $salario_prom += $profesion->salario_mensual;
    $salario_graph[$profesion->nombre] = $profesion->salario_mensual;

    if ($mayor_salario === null || $profesion->salario_mensual > $mayor_salario->salario_mensual) {
        $mayor_salario = $profesion;
    }

    if ($menor_salario === null || $profesion->salario_mensual < $menor_salario->salario_mensual) {
        $menor_salario = $profesion;
    }

    if (!isset($personasXprofesion[$profesion->idx])) {
        $personasXprofesion[$profesion->idx] = [
            "nombre" => $profesion->nombre,
            "cantidad" => 0
        ];
    }
}

foreach ($personajes as $personaje) {
    $edad_total += $personaje->edad();
    $excom += $personaje->nivel_experiencia;

    $salario = $personaje->salario_mensual();
    if ($per_mayor_salario["salario"] < $salario) {
        $per_mayor_salario = [
            "nombre" => $personaje->nombre,
            "salario" => $salario,
        ];
    }

    if (isset($personasXprofesion[$personaje->profesion])) {
        $personasXprofesion[$personaje->profesion]['cantidad']++;
    }
}

$eprom = $edad_total / count($personajes);
$excom = $excom / count($personajes);
$salario_prom = $salario_prom / count($profesiones);

$data = [
    'personajes' => count($personajes),
    'profesiones' => count($profesiones),
    'edad_promedio' => $eprom,
    'nivel_experiencia_comun' => $excom,
];

plantilla::aplicar();
?>

<!-- Font Awesome para íconos -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<h1 class="text-center mb-4">🌸 Estadísticas del Mundo Barbie 🌸</h1>

<!-- Indicadores -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary h-100">
            <div class="card-body">
                <h5 class="card-title"> <i class="fa fa-users"></i> Personajes</h5>
                <p class="card-text fs-4"><?= $data['personajes']; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-secondary h-100">
            <div class="card-body">
                <h5 class="card-title"> <i class="fa fa-briefcase"></i> Profesiones</h5>
                <p class="card-text fs-4"> <?= $data['profesiones']; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success h-100">
            <div class="card-body">
                <h5 class="card-title"> <i class="fa fa-heartbeat"></i> Edad Promedio</h5>
                <p class="card-text fs-4"> <?= number_format($data['edad_promedio'], 0); ?> años</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning h-100">
            <div class="card-body">
                <h5 class="card-title"> <i class="fa fa-star"></i> Nivel de experiencia común</h5>
                <p class="card-text fs-4"> <?= number_format($data['nivel_experiencia_comun'], 2); ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Detalles y distribuciones -->
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Distribución de personajes por categoria</h5>
                <ul class="list-group">
                    <?php
                    foreach ($personasXprofesion as $idx => $fila) {
                        echo "<li class='list-group-item'>{$fila['nombre']}: {$fila['cantidad']} personajes</li>";
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
                <p><strong>Profesión con mayor salario:</strong> <?= $mayor_salario; ?></p>
                <p><strong>Profesión con menor salario:</strong> <?= $menor_salario; ?></p>
                <p><strong>Salario promedio:</strong> RD$<?= $salario_prom; ?></p>
                <p><strong>Personaje con mayor salario:</strong> <?= $per_mayor_salario["nombre"] . " (RD$" . $per_mayor_salario["salario"]; ?>)</p>
            </div>
        </div>
    </div>
</div>

<!-- Gráfico de los salarios -->
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title text-center">Distribución de salarios por categoría de profesión</h5>
        <canvas id="salaryChart" height="100"></canvas>
    </div>
</div>

<?php
$labels = array_keys($salario_graph);
$datos = array_values($salario_graph);
?>

<script>
    const ctx = document.getElementById('salaryChart').getContext('2d');
    const salaryChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($labels); ?>,
            datasets: [{
                label: 'Salario Promedio (RD$)',
                data: <?= json_encode($datos); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.7)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => "RD$" + value.toLocaleString()
                    }
                }
            }
        }
    });
</script>