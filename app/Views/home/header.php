<?php
$nombre = $_SESSION['name'] ?? 'Usuario';
?>
<link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/home/header.css">
<script src="<?= BASE_URL ?>/Assets/js/home/header.js"></script>

<header class="topbar">
    <div class="topbar-title">
        <h1>Dashboard</h1>
        <span class="topbar-subtitle">Panel</span>
    </div>

    <div class="topbar-actions">
        <button class="icon-btn" title="Notificaciones">
            <i class="fa-regular fa-bell"></i>
        </button>

        <div class="user-menu">
            <input type="checkbox" id="toggle-user-menu" hidden>
            <label for="toggle-user-menu" class="user-chip">
                <img src="<?= BASE_URL ?>/Assets/img/users/1.jpg" alt="Usuario" />
                <span><?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?></span>
                <i class="fa-solid fa-chevron-down chevron"></i>
            </label>

            <ul class="dropdown">
                <li>
                    <a href="<?= BASE_URL ?>/Perfil">
                        <i class="fa-regular fa-user"></i> Mi perfil
                    </a>
                </li>
                <li>
                    <a href="<?= BASE_URL ?>/Configuracion">
                        <i class="fa-solid fa-gear"></i> Configuración
                    </a>
                </li>
                <li class="theme-toggle">
                    <button id="themeToggleBtn" onclick="cambiarModo()">
                        <i class="fa-solid fa-moon"></i>
                        <span>Cambiar tema</span>
                    </button>
                </li>
                <li>
                    <a href="<?= BASE_URL ?>/Logout">
                        <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>