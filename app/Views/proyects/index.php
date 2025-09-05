<link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/proyects/proyects.css">

<?php if (!empty($proyectos) && count($proyectos) > 0): ?>
    <a class="title">MIS PROYECTOS</a>
    <table class="proyects-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($proyectos as $proyecto): ?>
                <tr>
                    <td><?= htmlspecialchars($proyecto['nombre']) ?></td>
                    <td><?= htmlspecialchars($proyecto['tipo_id']) ?></td>
                    <td><?= htmlspecialchars($proyecto['estado_id']) ?></td>
                    <td><?= htmlspecialchars($proyecto['fecha_inicio']) ?></td>
                    <td><?= htmlspecialchars($proyecto['fecha_fin']) ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/Home/Proyectos/Ver-Proyecto/<?= $proyecto['id'] ?>" class="view-details-button">
                            Ver Detalles
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <a class="title">NO TIENES UN NUEVO PROYECTO, CREA UNO</a>
<?php endif; ?>

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