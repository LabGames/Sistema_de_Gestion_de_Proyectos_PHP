<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Empresa X</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/np_abp_ac.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <script src="<?= BASE_URL ?>/Assets/js/date_system.js"></script>
    <script>
        const BASE_URL = "<?= BASE_URL ?>";
    </script>
    <script src="<?= BASE_URL ?>/Assets/js/load_button.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <main> 
        <form id="form-proyecto" method="post" action="<?= BASE_URL ?>/Guardando_Proyecto" data-base-url="<?= BASE_URL ?>" enctype="multipart/form-data" novalidate>
            <nav>
                <table>
                    <tr>
                        <th colspan="2"><a class="title">NUEVO PROYECTO</a></th>
                    </tr>
                    <tr> 
                        <th colspan="2"><a class="mini-title">Nombre del Proyecto:</a></th>
                    </tr>
                    <tr>
                        <th colspan="2"><input type="text" name="project_name" placeholder="Ingrese el nombre del proyecto" required></th>
                    </tr>
                    <tr>
                        <th colspan="2"><a class="mini-title">Tipo de Proyecto:</a></th>
                    </tr>
                    <tr>
                        <th colspan="2">
                            <select name="project_type" required>
                                <?php foreach ($tipos_value as $tipo): ?>
                                    <option value="<?= $tipo['id'] ?>">
                                        <?= htmlspecialchars($tipo['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2"><a class="mini-title">Asociar Colaboradores:</a></th>
                    </tr>
                    <tr>
                        <th colspan="2">
                            <select name="collab-asso" placeholder="Selecionar un Colaborador" required>
                            <?php foreach ($clientes_value as $cliente): ?>
                                    <option value="<?= $cliente['id'] ?>">
                                        <?= htmlspecialchars($cliente['nombre_cliente']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2"><a class="mini-title">Estado:</a></th>
                    </tr>
                    <tr>
                        <th colspan="2">
                            <select  name="state" placeholder="Seleccionar un Estado:" required>
                                <?php foreach ($estados_value as $estado): ?>
                                    <option value="<?= $estado['id'] ?>">
                                        <?= htmlspecialchars($estado['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2"><a class="mini-title">Fecha de (Inicio/Fin):</a></th>
                    </tr>
                    <tr>
                        <td>
                            <input type="date" class="date" name="start_date" id="start_date" required readonly>
                            <input type="date" class="date" name="end_date" id="end_date" required>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2"><a class="mini-title">Tiempo Estimado:</a></th>
                    </tr>
                    <tr>
                        <th colspan="2"><input type="text" name="estimated_time" id="estimated_time" placeholder="Ingrese el tiempo estimado" required readonly></th>
                    </tr>
                    <tr>
                        <th colspan="2"><a class="mini-title">Comentario de Pronostico:</a></th>
                    </tr>
                    <tr>
                        <th colspan="2"><textarea name="forecast_comment" placeholder="Ingrese un comentario sobre el pronóstico del proyecto" required></textarea></th>
                    </tr>
                    <tr>
                        <th colspan="2"><a class="mini-title">Ingresos Estimados:</a></th>
                    </tr>
                    <tr>
                        <th colspan="2"><input type="number" name="estimated_income" placeholder="Ingrese los ingresos estimados" required></th>
                    </tr>
                    <tr>
                        <th colspan="2"><a class="mini-title">Adjuntar Archivos:</a></th>
                    </tr>
                    <tr>
                        <th colspan="2"><input type="file" name="project_files[]" accept=".pdf,.docx,.xlsx" placeholder="Ingrese un archivo" multiple></th>
                    </tr>
                    <tr>
                        <th colspan="2"><button type="submit" class="btn-style">Registrar Proyecto</button></th>
                    </tr>
                </table>
            </nav>
        <form>
    </main>

    <footer>
        <table class="footer-table">
            <tr>
                <th>
                    <form action="<?= BASE_URL ?>/Home/Proyectos" method="get">
                        <button class="title_button">Regresar</button>
                    </form>
                </th>
                <th><img class="ico_img" src="<?= BASE_URL ?>/Assets/img/logo.png" alt="Planeta" class="task-image" width="200" height="200"></th>
            </tr>
        </table>
    </footer> 
</body>
</html>