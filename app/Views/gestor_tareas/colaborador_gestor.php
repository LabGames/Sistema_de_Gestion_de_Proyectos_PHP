<div class="container mt-4">
    <h2 class="mb-4">Gestor de Tareas</h2>

    <ul class="nav nav-tabs" id="miTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button"
                role="tab">Asignar Tareas</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button"
                role="tab">Mis Tareas</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3" type="button"
                role="tab">Panel Admin</button>
        </li>
    </ul>

    <div class="tab-content mt-3" id="miTabContent">
        <div class="tab-pane fade show active" id="tab1" role="tabpanel">
            <div class="card p-4 shadow-lg rounded-4">
                <h4 class="mb-3 text-center">📋 Tareas Disponibles</h4>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="🔍 Buscar tarea..." id="search-assign-tasks">
                </div>
                <p class="text-muted text-center">Selecciona una tarea para comenzar a trabajar en ella.</p>
                <ul class="list-group" id="assign-task-list">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Reforestar Bosque de Jicamarca
                        <button class="btn btn-sm btn-primary assign-task-btn">Asignar</button>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Limpiar Muros Básicos
                        <button class="btn btn-sm btn-primary assign-task-btn">Asignar</button>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Campaña contra la Tala de Árboles
                        <button class="btn btn-sm btn-primary assign-task-btn">Asignar</button>
                    </li>
                </ul>
            </div>
        </div>

        <div class="tab-pane fade" id="tab2" role="tabpanel">
            <div class="card p-4 shadow-lg rounded-4">
                <h4 class="mb-3 text-center">✅ Mis Tareas Asignadas</h4>
                <div class="row text-center mb-4">
                    <div class="col">
                        <div class="p-3 bg-secondary rounded-3 text-white">
                            <h5 id="total-tareas">0</h5>
                            <small>Tareas Asignadas</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 bg-success rounded-3 text-white">
                            <h5 id="tareas-completadas">0</h5>
                            <small>Tareas Completadas</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 bg-warning rounded-3 text-white">
                            <h5 id="tareas-pendientes">0</h5>
                            <small>Tareas Pendientes</small>
                        </div>
                    </div>
                </div>
                <ul class="list-group" id="my-task-list">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" data-task-id="1">
                            <label class="form-check-label" for="task-1">Rescatar Animales</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-warning me-2 status-badge">En progreso</span>
                            <div class="action-buttons">
                                <button class="btn btn-sm btn-info text-white send-proofs-btn">Enviar Pruebas</button>
                                <button class="btn btn-sm btn-info text-white view-proofs-btn d-none">Ver Pruebas</button>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" data-task-id="2" checked>
                            <label class="form-check-label" for="task-2">Campaña contra la Tala</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-success me-2 status-badge">Completada</span>
                            <div class="action-buttons">
                                <button class="btn btn-sm btn-info text-white send-proofs-btn d-none">Enviar Pruebas</button>
                                <button class="btn btn-sm btn-info text-white view-proofs-btn">Ver Pruebas</button>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="mt-4 text-center">
                    <p class="text-muted">Progreso:</p>
                    <div style="width: 250px; height: 250px; margin: auto;">
                        <canvas id="task-progress-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="tab3" role="tabpanel">
            <div class="card p-4 shadow-lg rounded-4">
                <h4 class="mb-3 text-center">⚙️ Panel Admin</h4>
                <p class="text-muted text-center">Este panel es para crear y gestionar todas las tareas del sistema.</p>
                <div class="mb-3">
                    <button class="btn btn-success w-100 mb-3" data-bs-toggle="modal" data-bs-target="#nuevaTareaModal">➕ Crear Nueva Tarea</button>
                </div>
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tarea</th>
                            <th>Colaboradores</th>
                            <th>Fecha Límite</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Reforestar Bosque</td>
                            <td>Juan, María</td>
                            <td>20/09/2025</td>
                            <td>
                                <button class="btn btn-sm btn-warning">✏️ Editar</button>
                                <button class="btn btn-sm btn-danger">🗑️ Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Limpiar Muros</td>
                            <td>Carlos, Ana</td>
                            <td>18/09/2025</td>
                            <td>
                                <button class="btn btn-sm btn-warning">✏️ Editar</button>
                                <button class="btn btn-sm btn-danger">🗑️ Eliminar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="nuevaTareaModal" tabindex="-1" aria-labelledby="nuevaTareaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevaTareaModalLabel">Crear Nueva Tarea</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="nombreTarea" class="form-label">Nombre de la Tarea</label>
                        <input type="text" class="form-control" id="nombreTarea"
                            placeholder="Escribe el nombre de la tarea">
                    </div>
                    <div class="mb-3">
                        <label for="descripcionTarea" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcionTarea" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="colaboradores" class="form-label">Asociar Colaboradores</label>
                        <select class="form-select" id="colaboradores" multiple="multiple">
                            <option value="1">Juan Pérez</option>
                            <option value="2">María Gómez</option>
                            <option value="3">Carlos Díaz</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fechaLimite" class="form-label">Fecha Límite</label>
                        <input type="date" class="form-control" id="fechaLimite">
                    </div>
                    <button type="submit" class="btn btn-gradient w-100">Crear Tarea</button>
                </form>
            </div>
        </div>
    </div>
</div>