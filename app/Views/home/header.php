
<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$nombre = $_SESSION['name'] ?? 'Usuario';
?>
<link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/home/header.css">
<header class="topbar">
    <div class="topbar-title">
        <h1>Dashboard</h1>
        <span class="topbar-subtitle">Panel</span>
    </div>

    <div class="topbar-actions">
        <button class="icon-btn" title="Notificaciones">
            <i class="fa-regular fa-bell"></i>
        </button>

        <div class="user-chip" title="Cuenta">
            <img src="<?= BASE_URL ?>/Assets/img/users/1.jpg" alt="Usuario" />
            <span><?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?></span>
            <i class="fa-solid fa-chevron-down"></i>
        </div>
    </div>
</header>