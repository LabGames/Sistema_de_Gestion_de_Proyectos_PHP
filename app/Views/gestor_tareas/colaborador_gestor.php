<script src="<?= BASE_URL ?>/Assets/js/tareas/tareas.js"></script> 
    <script src="<?= BASE_URL ?>/Assets/js/tareas/mis_tareas.js"></script>
    <script src="<?= BASE_URL ?>/Assets/js/tareas/admin.js"></script>

<ul class="nav nav-tabs" id="miTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab" aria-controls="tab1" aria-selected="true">Asignar Tareas</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab" aria-controls="tab2" aria-selected="false">Mis Tareas</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3" type="button" role="tab" aria-controls="tab3" aria-selected="false">Admin</button>
  </li>
</ul>

<div class="tab-content mt-3" id="miTabContent">

  <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
    <div class="card p-4 shadow-sm">
      <h4 class="mb-3">Asignar Tareas Disponibles</h4>
      <input type="text" id="search-assign" class="form-control mb-3" placeholder="🔍 Buscar tarea (Asignar)...">
      <ul id="assign-task-list" class="list-group"></ul>
    </div>
  </div>

  <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
    <div class="card p-4 shadow-sm">
      <h4 class="mb-3">Mis Tareas</h4>
      <input type="text" id="search-my" class="form-control mb-3" placeholder="🔍 Buscar tarea (Mis Tareas)...">
      <div class="d-flex gap-3 mb-3 flex-wrap" id="my-task-cards"></div>
      <ul id="my-task-list" class="list-group mb-3"></ul>
      <div class="text-center" style="max-width:360px;margin:auto;">
        <canvas id="task-progress-chart" width="300" height="300" aria-label="Progreso de tareas"></canvas>
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
    <div class="card p-4 shadow-sm">
      <h4 class="mb-3">Gestión de Tareas (CRUD)</h4>
      <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCrear">
        Crear Nueva Tarea
      </button>
      <input type="text" id="search-admin" class="form-control mb-3" placeholder="🔍 Buscar tarea (Admin)...">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Colaborador</th>
              <th scope="col">Estado</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody id="admin-task-list">
            <tr>
              <th scope="row">1</th>
              <td>Diseño UI/UX</td>
              <td>Ana López</td>
              <td>Pendiente</td>
              <td>
                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detallesModal">Ver</button>
                <button class="btn btn-sm btn-warning">Editar</button>
                <button class="btn btn-sm btn-danger">Eliminar</button>
              </td>
            </tr>
             <tr>
              <th scope="row">2</th>
              <td>Desarrollo Backend</td>
              <td>Carlos Ruiz</td>
              <td>En Progreso</td>
              <td>
                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detallesModal">Ver</button>
                <button class="btn btn-sm btn-warning">Editar</button>
                <button class="btn btn-sm btn-danger">Eliminar</button>
              </td>
            </tr>
             <tr>
              <th scope="row">3</th>
              <td>Pruebas QA</td>
              <td>Sofía Castro</td>
              <td>Completada</td>
              <td>
                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detallesModal">Ver</button>
                <button class="btn btn-sm btn-warning">Editar</button>
                <button class="btn btn-sm btn-danger">Eliminar</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

<div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="formCrear">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCrearLabel">Nueva Tarea</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="tareaNombre" class="form-label">Nombre de la tarea</label>
            <input type="text" id="tareaNombre" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="tareaDetalle" class="form-label">Detalle</label>
            <textarea id="tareaDetalle" class="form-control" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="tareaColaborador" class="form-label">Colaborador</label>
            <input type="text" id="tareaColaborador" class="form-control" required>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="tareaInicio" class="form-label">Fecha de inicio</label>
              <input type="date" id="tareaInicio" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="tareaLimite" class="form-label">Fecha límite</label>
              <input type="date" id="tareaLimite" class="form-control" required>
            </div>
          </div>
          <input type="hidden" id="tareaId">
        </div>
        <div class="modal-footer">
          <button type="submit" id="crearBtn" class="btn btn-primary">Crear Tarea</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="detallesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detallesModalLabel">Detalles de la Tarea</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <p><strong>Nombre:</strong> <span id="modalNombreDetalle"></span></p>
        <p><strong>Colaborador:</strong> <span id="modalColaboradorDetalle"></span></p>
        <p><strong>Detalle de la tarea:</strong> <span id="modalDetalleDetalle"></span></p>
        <p><strong>Fecha de inicio:</strong> <span id="modalInicioDetalle"></span></p>
        <p><strong>Fecha límite:</strong> <span id="modalLimiteDetalle"></span></p>
        <p><strong>Estado:</strong> <span id="modalEstadoDetalle"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>