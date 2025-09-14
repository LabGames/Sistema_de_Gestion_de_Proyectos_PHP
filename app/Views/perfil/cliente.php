<?php include __DIR__ . "/modal_contactos.php"; ?>
<script src="<?= BASE_URL ?>/Assets/js/perfil/cliente.js"></script>

<div class="container-tabs">
    <div class="tabs">
        <div class="tab active" onclick="showTab('empresa', event)">Perfil</div>
        <div class="tab" onclick="showTab('contactos', event)">Contactos</div>
    </div>

    <div id="empresa" class="tab-content-perfil active">
        <h2>Datos</h2>
        <form id="formActualizarDatosCliente">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" id="nombre_cliente" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Empresa</label>
                <input type="text" id="empresa_cliente" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Rubro</label>
                <input type="text" id="rubro_cliente" autocomplete="off">
            </div>
            <div class="btn-container">
                <button type="button" class="btn-primary-custom" onclick="ActualizarDatos()">Actualizar</button>
            </div>
        </form>
    </div>

    <div id="contactos" class="tab-content-perfil">
        <div class="table-head">
            <h2>Contactos</h2>
            <button class="table-button-head" onclick="nuevoContacto()"><i class="fa-solid fa-phone"></i> Nuevo</button>
        </div>
        <table id="tablaContactos" style="width: 100%;">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
</div>