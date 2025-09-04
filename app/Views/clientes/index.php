<link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/clientes/clientes.css">
<script src="<?= BASE_URL ?>/Assets/js/clientes/clientes.js"></script>
<?php include __DIR__ . "/modal.php"; ?>

<div class="form-container">
  <h2>Registrar Cliente</h2>
  <form id="formClientes">
    <div id="smartwizard" class="smartwizardCustom">
      <ul class="nav">
        <li><a class="nav-link">Datos Generales</a></li>
        <li><a class="nav-link" >Contacto</a></li>
        <li><a class="nav-link">Credenciales</a></li>
      </ul>

      <div class="tab-content">
        
        <div id="step-1" class="tab-pane" role="tabpanel">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" placeholder="Ingresa el nombre del cliente" autocomplete="off" />
          </div>
          <div class="form-group">
            <label for="empresa">Empresa</label>
            <input type="text" id="empresa" placeholder="Ingresa el nombre de la empresa" autocomplete="off" />
          </div>
          <div class="form-group">
            <label for="rubro">Rubro</label>
            <input type="text" id="rubro" placeholder="Ingresa el rubro de la empresa" autocomplete="off" />
          </div>
          <div class="form-group">
            <label for="estado">Estado</label>
            <select id="estado">
              <option value="">Selecciona un estado</option>
            </select>
          </div>
        </div>
        
        <div id="step-2" class="tab-pane" role="tabpanel">
          <div class="form-group">
            <label for="nombre_contacto">Nombre del contacto</label>
            <input type="text" id="nombre_contacto" placeholder="Ingresa el nombre del contacto" autocomplete="off" />
          </div>
          <div class="form-group">
            <label for="correo">Correo del contacto</label>
            <input type="text" id="correo" placeholder="Ingresa el correo del contacto" autocomplete="off" />
          </div>
          <div class="form-group">
            <label for="telefono">Teléfono del contacto</label>
            <input type="text" id="telefono" placeholder="Ingresa el teléfono de la empresa" autocomplete="off" />
          </div>
        </div>
        
        <div id="step-3" class="tab-pane" role="tabpanel">
          <div class="form-group">
            <label for="correo_usuario">Correo</label>
            <input type="text" id="correo_usuario" placeholder="Ingresa el correo del usuario" autocomplete="off" />
          </div>
          <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" placeholder="********" autocomplete="off"/>
          </div>
          <div class="btn-container">
            <button type="button" class="btn-primary-custom" onclick="registrarCliente()">Registrar</button>
          </div>
        </div>

      </div>
    </div>
  </form>
</div>


<div class="table-container">
    <h2>Lista de Clientes</h2>
    <table id="tablaClientes" style="width:100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Empresa</th>
                <th>Rubro</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </table>
</div>