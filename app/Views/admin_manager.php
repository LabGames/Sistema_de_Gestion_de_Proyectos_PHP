<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Empresa X</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/np_abp_ac.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <script>
        const BASE_URL = "<?= BASE_URL ?>";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <main> 
        <nav class="container">
            <ul>
                <li>
                    <a class="title">JEFES DE PROYECTOS</a>
                </li>
                <li>
                    <a class="mini-subtitle">Proyecto Asociado: Campaña para el medio ambiente:</a>
                </li>
                <li class="user">
                    <input class="name" type="text" name="project_name" value="Miembro 1" required readonly>
                    <img class="icon" src="../images/logo.png.webp" alt="Planeta" class="task-image" width="50" height="50">
                    <button type="submit" class="btn-style">Eliminar</button>
                </li>
                <li class="user">
                    <input class="name" type="text" name="project_name" value="Miembro 2" required readonly>
                    <img class="icon" src="../images/logo.png.webp" alt="Planeta" class="task-image" width="50" height="50">
                    <button type="submit" class="btn-style">Eliminar</button>
                </li>
                <li class="user">
                    <input class="name" type="text" name="project_name" value="Miembro 2" required readonly>
                    <img class="icon" src="../images/logo.png.webp" alt="Planeta" class="task-image" width="50" height="50">
                    <button type="submit" class="btn-style">Eliminar</button>
                </li>
                <li class="user">
                    <input class="name" type="text" name="project_name" value="Miembro 2" required readonly>
                    <img class="icon" src="../images/logo.png.webp" alt="Planeta" class="task-image" width="50" height="50">
                    <button type="submit" class="btn-style">Eliminar</button>
                </li>
                <li>
                    <button type="submit" class="btn-style">Añadir Jefe de Proyecto</button>
                </li>
            </ul>
        </nav>
    </main>

    <footer> 
        <button class="title_button">Regresar</button>
        <img src="../images/logo.png.webp" alt="Planeta" class="task-image" width="200" height="200">
    </footer>
</body>
</html>