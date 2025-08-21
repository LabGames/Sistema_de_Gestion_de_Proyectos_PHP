<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Tarea</title>
    <link rel="stylesheet" href="../../css/style_nueva_tarea.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h2 class="card-title">NUEVA TAREA</h2>
            <p class="project-info">Proyecto Asociado: Campaña para el medio ambiente</p>
            <form action="" method="post">
                <div class="form-group">
                    <label for="nombre-tarea">Nombre de la Tarea:</label>
                    <input type="text" id="nombre-tarea" name="nombre_tarea">
                </div>
                <div class="form-group">
                    <label for="colaboradores">Asociar Colaboradores:</label>
                    <select id="colaboradores" name="colaborador_id">
                        <option value="1">Colaborador 1</option>
                        <option value="2">Colaborador 2</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fecha-limite">Fecha Límite:</label>
                    <input type="date" id="fecha-limite" name="fecha_limite">
                </div>
                <button type="submit" class="btn-nueva-tarea">Añadir Tarea</button>
            </form>
        </div>
        <button class="btn-regresar">Regresar</button>
    </div>
</body>
</html>