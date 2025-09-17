<?php if (!empty($proyectos) && count($proyectos) > 0): ?>
    <link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/proyects/proyects_2.css">
    <script src="<?= BASE_URL ?>/Assets/js/search_system.js"></script>

    <a class="title">MIS PROYECTOS</a>
    <table class="proyects-table">
        <thead class="table-header">
            <tr>
                <th colspan ="6">
                    <input type="text" id="search_proyect" placeholder="Buscar">
                    <select name="filter_state" id="filter_state">
                        <option value="">Filtrar por Estado</option>
                        <?php foreach ($estados_value as $estado): ?>
                            <option value="<?= htmlspecialchars($estado['nombre']) ?>"><?= htmlspecialchars($estado['nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="state" id="filter_date">
                        <option value="">Filtrar por Fecha</option>
                        <?php foreach ($proyectos as $proyecto): ?>
                            <option value="<?= htmlspecialchars($proyecto['fecha_inicio']) ?>"><?= htmlspecialchars($proyecto['fecha_inicio']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </th>
            </tr>
        </thead>
        <tbody class="table-body">
        <?php foreach ($proyectos as $proyecto): ?>
            <tr>
                <td>
                    <div class="proyect-card">
                        <div class="proyect-header">
                            <span class="proyect-title"><?= htmlspecialchars($proyecto['nombre']) ?></span>
                            <span class="proyect-status"><?= htmlspecialchars($map_estados[$proyecto['estado_id']] ?? 'Desconocido') ?></span>
                        </div>
                        <div class="proyect-body">
                            <p><strong>Tipo:</strong> <?= htmlspecialchars($map_tipos[$proyecto['tipo_id']] ?? 'Desconocido') ?></p>
                            <p><strong>Inicio:</strong> <?= htmlspecialchars($proyecto['fecha_inicio']) ?></p>
                            <p><strong>Fin:</strong> <?= htmlspecialchars($proyecto['fecha_fin']) ?></p>
                        </div>
                        <div class="proyect-actions">
                            <a class="button" href="<?= BASE_URL ?>/Home/Proyectos/Ver-Proyecto/<?= $proyecto['id'] ?>">Gestionar</a>
                            <a class="button" href="<?= BASE_URL ?>/Home/Proyectos/Borrar-Proyecto/<?= $proyecto['id'] ?>">Borrar</a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
    <form action="<?= BASE_URL ?>/Home/Proyectos/Crear-Nuevo-Proyecto" method="get">
        <button type="submit" class="new-proyect-panel">
            <span class="user-plus">
                <i class="fa-solid fa-folder"></i>
                <i class="fa-solid fa-plus"></i>
                <span class="title_button">Crear Nuevo Proyecto</span>
            </span>
        </button>
    </form>
<?php else: ?>
    <link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/proyects/proyects.css">
    
    <a class="title">NO TIENES UN NUEVO PROYECTO, CREA UNO</a>

    <form action="<?= BASE_URL ?>/Home/Proyectos/Crear-Nuevo-Proyecto" method="get">
        <button type="submit" class="new-proyect-panel">
            <table>
                <tr>
                    <th colspan="2">
                        <span class="user-plus">
                            <i class="fa-solid fa-folder"></i>
                            <i class="fa-solid fa-plus"></i>
                        </span>
                    </th>
                </tr>
                <tr>
                    <th colspan="2">
                        <span class="title_button">Crear Nuevo Proyecto</span>
                    </th>
                </tr>
            </table>
        </button>
    </form>
<?php endif; ?>

