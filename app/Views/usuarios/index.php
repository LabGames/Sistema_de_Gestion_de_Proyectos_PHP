<link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
<link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/usuarios/usuarios.css">
<script src="<?= BASE_URL ?>/Assets/js/usuarios/usuarios.js"></script>
<?php include __DIR__ . "/modal.php"; ?>

<div class="form-container">
    <h2>Registrar Usuario</h2>
    <form id="formRegistrarUsuario">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" placeholder="Nombre del usuario" autocomplete="off" />
        </div>

        <div class="form-group">
            <label for="rol">Rol</label>
            <select id="rol">
                <option value="">Selecciona un rol</option>
            </select>
        </div>

        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" id="correo" placeholder="usuario@correo.com" autocomplete="off"/>
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" placeholder="********" autocomplete="off"/>
        </div>
        <div class="btn-container"><button type="button" class="btn-primary-custom" onclick="registrarUsuario()">Registrar</button></div>

    </form>
</div>

<div class="table-container">
    <h2>Lista de Usuarios</h2>
    <table id="tablaUsuarios" style="width:100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Estado</th>
                <th>Activar/Inhabilitar</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </table>
</div>