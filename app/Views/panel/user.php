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
?>
<link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/panel/user.css">

<div class="panel-user">
    <h1 class="bienvenida-panel">Te damos la bienvenida, <?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?></h1>

    <section class="resumen-panel">
        <h2 class="resumen-text"><i class="fa-solid fa-chart-line"></i> Resumen General</h2>
        <div class="stats-panel">
            <div class="stat-card-panel">
                <i class="fa-solid fa-diagram-project"></i>
                <h3><?= $metricas["proyectos"] ?></h3>
                <p>Proyectos Activos</p>
            </div>
            <div class="stat-card-panel">
                <i class="fa-solid fa-tasks"></i>
                <h3><?= $metricas["tareasPendientes"] ?></h3>
                <p>Tareas Pendientes</p>
            </div>
            <div class="stat-card-panel">
                <i class="fa-solid fa-check-circle"></i>
                <h3><?= $metricas["tareasCompletadas"] ?></h3>
                <p>Tareas Completadas</p>
            </div>
            <div class="stat-card-panel">
                <i class="fa-solid fa-clock"></i>
                <h3><?= $metricas["horasEstimadas"] ?>h</h3>
                <p>Horas Estimadas</p>
            </div>
        </div>
    </section>

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

    <section class="tareas-panel">
        <h2><i class="fa-solid fa-list-check"></i> Tareas pendientes</h2>
        <table class="tareas-table-panel">
            <thead>
                <tr>
                    <th>Proyecto</th>
                    <th>Tarea</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tareas as $t): ?>
                    <?php 
                        $proyecto = array_filter($proyectos, fn($p) => $p["id"] == $t["proyecto_id"]);
                        $proyecto = reset($proyecto)["nombre"] ?? "N/A";
                        $estadoClass = match($t["estado"]) {
                            "Pendiente"   => "badge-panel badge-warning-panel",
                            "En Progreso" => "badge-panel badge-info-panel",
                            "Completado"  => "badge-panel badge-success-panel",
                            default       => "badge-panel",
                        };
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($proyecto) ?></td>
                        <td><?= htmlspecialchars($t["titulo"]) ?></td>
                        <td><span class="<?= $estadoClass ?>"><?= $t["estado"] ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>
