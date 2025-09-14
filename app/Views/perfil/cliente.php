<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <style>
        .tabs {
            display: flex;
            border-bottom: 1px solid #2d2f36;
            margin-bottom: 20px;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            font-size: 14px;
            color: #a1a1aa;
            border-bottom: 2px solid transparent;
            transition: all 0.3s;
        }

        .tab.active {
            color: #fff;
            border-bottom: 2px solid #4f46e5;
        }

        .tab:hover {
            color: #fff;
        }

        .tab-content {
            display: none;
            background: #181a20;
            border: 1px solid #2d2f36;
            border-radius: 6px;
            padding: 20px;
        }

        .tab-content.active {
            display: block;
        }

    </style>
</head>
<?php include __DIR__ . "/modal_contactos.php"; ?>
<script src="<?= BASE_URL ?>/Assets/js/perfil/cliente.js"></script>

<body>

    <div class="form-container">
        <div class="tabs">
            <div class="tab active" onclick="showTab('empresa', event)">Perfil de Empresa</div>
            <div class="tab" onclick="showTab('contactos', event)">Contactos</div>
        </div>

        <div id="empresa" class="tab-content active">
            <h2>Datos del Cliente</h2>
            <div class="form-group">
                <label>Nombre del Cliente</label>
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
        </div>

        <div id="contactos" class="tab-content">
            <div class="table-container">
                <h2>Contactos</h2>
                <button class="btn" onclick="nuevoContacto()">Agregar Contacto</button>
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
    </div>
</body>

</html>