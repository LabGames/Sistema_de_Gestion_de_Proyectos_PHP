<link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/proyects/proyects.css">

<a class="title">NO TIENES UN NUEVO PROYECTO, CREA UNO</a>

<form action="<?= BASE_URL ?>/Home/Proyectos/Crear-Nuevo-Proyecto" method="get">
    <button type="submit" class="new-proyect-panel">
        <table>
            <tr>
                <th colspan="2">
                    <span class="user-plus">
                        <i class="fa-solid fa-folder"></i>
                        <i class="fa-solid fa-plus"></i>
                    </span>
                </th>
            </tr>
            <tr>
                <th colspan="2">
                    <span class="title_button">Crear Nuevo Proyecto</span>
                </th>
            </tr>
        </table>
    </button>
</form>
