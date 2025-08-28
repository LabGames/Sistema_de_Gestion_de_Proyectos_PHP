<div id="clienteModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Editar Cliente</h2>
            <span class="close-btn" onclick="cerrarModal()">
                <i class="fa-solid fa-xmark"></i>
            </span>
        </div>
        <form id="formActualizarCliente">
            <input type="hidden" id="id_cliente">
            <input type="hidden" id="id_user">

            <div class="form-group-modal">
                <label for="nombre_modal">Nombre del cliente</label>
                <input type="text" id="nombre_modal" placeholder="Ingresa el nombre">
            </div>

            <div class="form-group-modal">
                <label for="empresa_modal">Empresa</label>
                <input type="text" id="empresa_modal" placeholder="Ingresa el nombre">
            </div>

            <div class="form-group-modal">
                <label for="rubro_modal">Rubro</label>
                <input type="text" id="rubro_modal" placeholder="Ingresa el nombre">
            </div>

            <div class="form-group-modal">
                <label for="contacto_modal">Contacto Principal</label>
                <select id="contacto_modal">
                    <option value="">Selecciona un contacto</option>
                </select>
            </div>

            <div class="form-group-modal">
                <label for="estado_modal">Estado</label>
                <select id="estado_modal">
                    <option value="">Selecciona un estado</option>
                </select>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancelar" onclick="cerrarModal()">
                    Cancelar
                </button>
                <button type="button" class="btn-guardar" onclick="actualizarCliente()">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>