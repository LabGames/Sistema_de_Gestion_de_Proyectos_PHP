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

        h2 {
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 18px;
            color: #fff;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 13px;
            margin-bottom: 5px;
            color: #a1a1aa;
        }

        input {
            width: 100%;
            padding: 8px 10px;
            background: #0f1117;
            border: 1px solid #2d2f36;
            border-radius: 4px;
            color: #fff;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 4px #4f46e5;
        }

        /* Botón */
        .btn {
            padding: 6px 12px;
            background-color: #4f46e5;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .btn:hover {
            background-color: #4338ca;
        }

        /* Ajustes DataTable */
        .dataTables_wrapper {
            color: #e5e5e5;
        }

        table.dataTable {
            border-collapse: collapse;
            width: 100%;
            background: #0f1117;
        }

        table.dataTable th {
            background: #181a20;
            color: #a1a1aa;
        }

        table.dataTable tbody tr {
            background: #181a20;
        }

        table.dataTable tbody tr:nth-child(even) {
            background: #20222a;
        }

        table.dataTable tbody tr:hover {
            background: #2a2c34;
        }
    </style>
</head>
<script src="<?= BASE_URL ?>/Assets/js/contactos/contactos.js"></script>

<body>

    <div class="form-container">
        <div class="tabs">
            <div class="tab active" onclick="showTab('empresa', event)">Perfil de Empresa</div>
            <div class="tab" onclick="showTab('contactos', event)">Contactos</div>
        </div>

        <div id="empresa" class="tab-content active">
            <h2>Datos de la Empresa</h2>
            <div class="form-group">
                <label>Razón Social</label>
                <input type="text" placeholder="Ej: Empresa X S.A.C.">
            </div>
            <div class="form-group">
                <label>RUC</label>
                <input type="text" placeholder="Ej: 20123456789">
            </div>
            <div class="form-group">
                <label>Dirección</label>
                <input type="text" placeholder="Ej: Av. Principal 123">
            </div>
        </div>

        <div id="contactos" class="tab-content">
            <div class="table-container">
                <h2>Contactos</h2>
                <button class="btn">Agregar Contacto</button>
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