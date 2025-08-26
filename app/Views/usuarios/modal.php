<div id="userModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Nuevo Usuario</h2>
      <span class="close-btn" onclick="cerrarModal()">
        <i class="fa-solid fa-xmark"></i>
      </span>
    </div>
    <form id="formActualizarUsuario">
      <input type="hidden" id="id_user">

      <div class="form-group-modal">
        <label for="nombre_modal">Nombre</label>
        <input type="text" id="nombre_modal" placeholder="Ingresa el nombre" required>
      </div>

      <div class="form-group-modal">
        <label for="correo_modal">Correo</label>
        <input type="email" id="correo_modal" placeholder="usuario@correo.com" required>
      </div>

      <div class="form-group-modal">
        <label for="password_modal">Contraseña</label>
        <input type="password" id="password_modal" placeholder="********" required>
      </div>

      <div class="form-group-modal">
        <label for="rol_modal">Rol</label>
        <select id="rol_modal" required>
          <option value="">Selecciona un rol</option>
        </select>
      </div>

      <div class="modal-actions">
        <button type="button" class="btn-cancelar" onclick="cerrarModal()">
          Cancelar
        </button>
        <button type="button" class="btn-guardar" onclick="actualizarUsuario()">
          Guardar
        </button>
      </div>
    </form>
  </div>
</div>
