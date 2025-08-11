<?php
session_start();

$proyecto = [
    "id" => "12345",
    "cliente" => "Cliente Ejemplo",
    "colaborador" => "Juan Pérez",
    "tareas" => ["", "", "", ""]
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tareas - Empresa X</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body class="GTareas-page">

    <header>
        <h1>EMPRESA X</h1>
        <a href="../../index.php" class="btn-register">REGRESAR</a>
    </header>

    <div class="task-container">
        <form action="procesar_GTareas.php" method="POST">
            <fieldset>
                <legend>Proyecto 1</legend>
                <ul>
                    <li><input type="radio" checked> ID del Proyecto: <?php echo $proyecto["id"]; ?></li>
                    <li><input type="radio" checked> Nombre del Cliente: <?php echo $proyecto["cliente"]; ?></li>
                    <li><input type="radio" checked> Nombre del Colaborador: <?php echo $proyecto["colaborador"]; ?></li>
                </ul>
                <img src="imges/logo.png.webp" alt="Planeta" class="task-image">
            </fieldset>

            <?php foreach ($proyecto["GTareas"] as $i => $tarea): ?>
                <label>Tarea <?php echo $i+1; ?></label>
                <div class="task-row">
                    <input type="text" name="GTareas[]" value="<?php echo htmlspecialchars($tarea); ?>">
                    <span class="star-icon">⭐</span>
                </div>
            <?php endforeach; ?>

            <div class="task-buttons">
                <button type="button" class="btn-black">AÑADIR TAREA</button>
                <button type="button" class="btn-black">ELIMINAR TAREA</button>
                <button type="submit" class="btn-black">GUARDAR</button>
            </div>
        </form>
    </div>

</body>
</html>
