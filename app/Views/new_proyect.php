<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Empresa X</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/style_new_proyect.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <script src="<?= BASE_URL ?>/Assets/js/date_system.js"></script>
    <script src="<?= BASE_URL ?>/Assets/js/load_button.js"></script>
    <script>
        const BASE_URL = "<?= BASE_URL ?>";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <main> 
        <nav>
            <ul>
                <li>
                    <a class="title">NUEVO PROYECTO</a>
                </li>
                <li>
                    <a class="mini-title">Nombre del Proyecto:</a>
                </li>
                <li>
                    <input type="text" name="project_name" placeholder="Ingrese el nombre del proyecto" required>
                </li>
                <li>
                    <a class="mini-title">Tipo de Proyecto:</a>
                </li>
                <li>
                    <select name="project_type" placeholder="Ingrese el tipo de proyecto" required>
                        <option value="importante">Importante</option>
                        <option value="semi_importante">Semi Importante</option>
                        <option value="secundario">Secundario</option>
                    </select>
                </li>
                <li>
                    <a class="mini-title">Asociar Colaboradores:</a>
                </li>
                <li>
                    <select name="collab-asso" placeholder="Selecionar un Colaborador" required>
                        <option value="Colaborador_1">Colaborador 1</option>
                        <option value="Colaborador_2">Colaborador 2</option>
                        <option value="Colaborador_3">Colaborador 3</option>
                    </select>
                </li>
                <li>
                    <a class="mini-title">Estado:</a>
                </li>
                <li>
                    <select  name="state" placeholder="Seleccionar un Estado:" required>
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                        <option value="finalizado">Finalizado</option>
                    </select>
                </li>
                <li>
                    <a class="mini-title">Fecha de (Inicio/Fin):</a>
                </li>
                <li>
                    <input type="date" class="date" name="start_date" id="start_date" required readonly>
                    <input type="date" class="date" name="end_date" id="end_date" required>
                </li>
                <li>
                    <a class="mini-title">Tiempo Estimado:</a>
                </li>
                <li>
                    <input type="text" name="estimated_time" id="estimated_time" placeholder="Ingrese el tiempo estimado" required readonly>
                </li>
                <li>
                    <a class="mini-title">Comentario de Pronostico:</a>
                </li>
                <li>
                    <textarea name="forecast_comment" placeholder="Ingrese un comentario sobre el pronóstico del proyecto" required></textarea>
                </li>
                <li>
                    <a class="mini-title">Ingresos Estimados:</a>
                </li>
                <li>
                    <input type="number" name="estimated_income" placeholder="Ingrese los ingresos estimados" required>
                </li>
                <li>
                    <a class="mini-title">Adjuntar Archivos:</a>
                </li>
                <li>
                    <input type="file" name="project_files" accept=".pdf,.docx,.xlsx" placeholder="Ingrese un archivo" multiple>
                </li>
                <li>
                    <button type="submit" class="btn-style">Registrar Proyecto</button>
                </li>
            </ul>
        </nav>
    </main>

    <footer>
        <button class="title_button">Regresar</button>
        <img src="<?= BASE_URL ?>/Assets/img/logo.png" alt="Planeta" class="task-image" width="200" height="200">
    </footer>
</body>
</html>