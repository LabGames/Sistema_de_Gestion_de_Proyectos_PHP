<script src="<?= BASE_URL ?>/Assets/js/perfil/usuario.js"></script>

<div class="container-tabs">
    <div class="tabs">
        <div class="tab active" >Perfil</div>
    </div>

    <div class="tab-content active">
        <h2>Datos</h2>
        <form id="formActualizarDatosUsuario">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" id="nombre" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Correo</label>
                <input type="email" id="correo" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="text" id="password" autocomplete="off">
            </div>
            <div class="btn-container">
                <button type="button" class="btn-primary-custom" onclick="ActualizarDatos()">Actualizar</button>
            </div>
        </form>
    </div>
</div>