<?php
$nombre = $_SESSION['name'] ?? 'Usuario';

$metricas = [
    "proyectos" => 5,
    "tareasPendientes" => 14,
    "tareasCompletadas" => 30,
    "horasEstimadas" => 120
];

$proyectos = [
    ["id" => 1, "nombre" => "Sistema de Inventario", "estado" => "En Progreso", "avance" => 60, "icono" => "fa-boxes-stacked"],
    ["id" => 2, "nombre" => "App de Ventas", "estado" => "Pendiente", "avance" => 20, "icono" => "fa-mobile-screen"],
    ["id" => 3, "nombre" => "Web Corporativa", "estado" => "Completado", "avance" => 100, "icono" => "fa-globe"],
];

$tareas = [
    ["proyecto_id" => 1, "titulo" => "Diseñar modelo ER", "estado" => "Pendiente"],
    ["proyecto_id" => 1, "titulo" => "Crear API de productos", "estado" => "En Progreso"],
    ["proyecto_id" => 2, "titulo" => "Definir arquitectura", "estado" => "Pendiente"],
];

$miembros = [
    ["nombre" => "Ana López", "aportaciones" => 12],
    ["nombre" => "Carlos Pérez", "aportaciones" => 9],
    ["nombre" => "María Fernández", "aportaciones" => 7],
    ["nombre" => "Luis Torres", "aportaciones" => 5],
];
?>
<link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/panel/admin.css">
<script src="<?= BASE_URL ?>/Assets/js/panel/admin.js"></script>

<div class="panel-user">
    <div id="metricas-data" data-metricas='<?= json_encode($metricas) ?>'></div>

    <h1 class="bienvenida-panel">Te damos la bienvenida, <?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?></h1>

    <section class="proyectos-access">
        <h2><i class="fa-solid fa-folder-open"></i> Acceso rápido a tus proyectos</h2>
        <div class="proyectos-grid-access">
            <?php foreach ($proyectos as $p): ?>
                <div class="proyecto-card-access">
                    <div class="proyecto-header-access">
                        <i class="fa-solid <?= $p["icono"] ?>"></i>
                        <h3><?= htmlspecialchars($p["nombre"]) ?></h3>
                    </div>
                    <p><b>Estado:</b> <?= $p["estado"] ?></p>
                    <div class="progress-bar-panel">
                        <div class="progress-panel" style="width: <?= $p["avance"] ?>%"></div>
                    </div>
                    <a href="<?= BASE_URL ?>/Proyectos/Detalle/<?= $p["id"] ?>" class="btn-proyecto-panel">
                        <i class="fa-solid fa-eye"></i> Ver Proyecto
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="metricas-panel">
        <h2><i class="fa-solid fa-chart-pie"></i> Métricas Generales</h2>
        <div class="metricas-grid">
            <div class="chart-container">
                <canvas id="tareasChart"></canvas>
            </div>

            <div class="miembros-panel">
                <h3><i class="fa-solid fa-users"></i> Miembros con más aportaciones</h3>
                <ul>
                    <?php foreach ($miembros as $m): ?>
                        <li>
                            <div class="miembro-info">
                                <div class="miembro-avatar">
                                    <?= strtoupper(substr($m["nombre"], 0, 1)) ?>
                                </div>
                                <span class="miembro-nombre"><?= htmlspecialchars($m["nombre"]) ?></span>
                            </div>
                            <span class="miembro-aportaciones"><?= $m["aportaciones"] ?> tareas</span>
                        </li>
                    <?php endforeach; ?>
                </ul>

            </div>
        </div>
    </section>
</div>

<script>
    const metricas = <?= json_encode($metricas) ?>;
</script>