<div id="contactoModalAgregar" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Nuevo Contacto</h2>
            <span class="close-btn" onclick="cerrarModalAgregar()">
                <i class="fa-solid fa-xmark"></i>
            </span>
        </div>
        <form id="formRegistrarContacto">
            <div class="form-group-modal">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" placeholder="Ingresa el nombre">
            </div>

            <div class="form-group-modal">
                <label for="correo">Correo</label>
                <input type="email" id="correo" placeholder="Ingresa el correo">
            </div>

            <div class="form-group-modal">
                <label for="telefono">Telefono</label>
                <input type="text" id="telefono" placeholder="Ingresa el telefono">
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancelar" onclick="cerrarModalAgregar()">
                    Cancelar
                </button>
                <button type="button" class="btn-guardar" onclick="registrarContacto()">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>
<div id="contactoModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Editar Contacto</h2>
            <span class="close-btn" onclick="cerrarModal()">
                <i class="fa-solid fa-xmark"></i>
            </span>
        </div>
        <form id="formActualizarContacto">
            <input type="hidden" id="id_contacto">

            <div class="form-group-modal">
                <label for="nombre_modal">Nombre</label>
                <input type="text" id="nombre_modal" placeholder="Ingresa el nombre">
            </div>

            <div class="form-group-modal">
                <label for="correo_modal">Correo</label>
                <input type="text" id="correo_modal" placeholder="Ingresa el correo">
            </div>

            <div class="form-group-modal">
                <label for="telefono_modal">Telefono</label>
                <input type="text" id="telefono_modal" placeholder="Ingresa el telefono">
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancelar" onclick="cerrarModal()">
                    Cancelar
                </button>
                <button type="button" class="btn-guardar" onclick="actualizarContacto()">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>