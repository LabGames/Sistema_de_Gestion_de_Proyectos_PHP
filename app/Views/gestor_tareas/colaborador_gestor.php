<!-- Estilos -->
<link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/tareas/tareas.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="form-container">
  <h2 class="text-center mb-4">📋 Gestor de Tareas</h2>

  <!-- SMARTWIZARD2 -->
  <div id="smartwizard2" class="smartwizardCustom">

    <!-- Pestañas -->
    <ul class="nav" role="tablist">
      <li>
        <a class="nav-link" href="#step-1" role="tab">
          <i class="fa-solid fa-tasks me-2"></i> Tareas Disponibles
        </a>
      </li>
      <li>
        <a class="nav-link" href="#step-2" role="tab">
          <i class="fa-solid fa-list-check me-2"></i> Mis Tareas
        </a>
      </li>
      <li>
        <a class="nav-link" href="#step-3" role="tab">
          <i class="fa-solid fa-gear me-2"></i> Administración
        </a>
      </li>
    </ul>

    <!-- Contenido de pestañas -->
    <div class="tab-content mt-3">

      <!-- TAB 1: TAREAS DISPONIBLES -->
      <div id="step-1" class="tab-pane" role="tabpanel">
        <div class="table-container">
          <h3>📌 Lista de Tareas</h3>
          <table id="tablaTareas" class="styled-table">
            <thead>
              <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Fecha Límite</th>
                <th>Prioridad</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody id="tbodyTareas">
              <!-- JS insertará filas -->
            </tbody>
          </table>
        </div>
      </div>

      <!-- TAB 2: MIS TAREAS -->
      <div id="step-2" class="tab-pane" role="tabpanel">

        <!-- Cards resumen -->
        <div class="summary-cards">
          <div class="card-summary pendiente">
            <div class="card-content">
              <i class="fa-solid fa-hourglass-half fa-2x icon"></i>
              <div class="text">
                <h4>Pendientes</h4>
                <p id="countPendientes">0</p>
              </div>
            </div>
          </div>

          <div class="card-summary finalizada">
            <div class="card-content">
              <i class="fa-solid fa-circle-check fa-2x icon"></i>
              <div class="text">
                <h4>Finalizadas</h4>
                <p id="countFinalizadas">0</p>
              </div>
            </div>
          </div>

          <div class="card-summary cancelada">
            <div class="card-content">
              <i class="fa-solid fa-circle-xmark fa-2x icon"></i>
              <div class="text">
                <h4>Canceladas</h4>
                <p id="countCanceladas">0</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Tabla Mis Tareas -->
        <div class="table-container">
          <h3>📝 Mis Tareas</h3>
          <table id="tablaMisTareas" class="styled-table">
            <thead>
              <tr>
                <th>Título</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody id="tbodyMisTareas">
              <!-- JS insertará filas -->
            </tbody>
          </table>
        </div>
      </div>

      <!-- TAB 3: ADMIN -->
      <div id="step-3" class="tab-pane" role="tabpanel">

        <!-- Formulario crear tarea -->
        <div class="form-container mb-4">
          <h3>➕ Crear Tarea</h3>
          <form id="formTareas">
            <div class="form-group">
              <label for="titulo">Título</label>
              <input type="text" id="titulo" placeholder="Ingresa el título de la tarea" autocomplete="off" required />
            </div>
            <div class="form-group">
              <label for="descripcion">Descripción</label>
              <textarea id="descripcion" placeholder="Describe la tarea" required></textarea>
            </div>
            <div class="form-group">
              <label for="fecha_limite">Fecha Límite</label>
              <input type="date" id="fecha_limite" required />
            </div>
            <div class="form-group">
              <label for="prioridad">Prioridad</label>
              <select id="prioridad" required>
                <option value="">Selecciona una prioridad</option>
                <option value="Alta">Alta</option>
                <option value="Media">Media</option>
                <option value="Baja">Baja</option>
              </select>
            </div>
            <div class="btn-container">
              <button type="submit" class="btn-primary-custom">Guardar</button>
            </div>
          </form>
        </div>

        <!-- Tabla administración -->
        <div class="table-container">
          <h3>📑 Tareas Registradas</h3>
          <table id="tablaAdminTareas" class="styled-table">
            <thead>
              <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Fecha Límite</th>
                <th>Prioridad</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody id="tbodyAdminTareas">
              <!-- JS insertará filas -->
            </tbody>
          </table>
        </div>
      </div>

    </div><!-- /tab-content -->
  </div><!-- /smartwizard2 -->
</div>

<!-- Script de tareas -->
<script src="<?= BASE_URL ?>/Assets/js/tareas/tareas.js"></script>
