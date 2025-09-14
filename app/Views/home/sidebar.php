<?php
$currentRoute = $_SERVER['REQUEST_URI']; 
?>
<link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/home/sidebar.css">
<input type="checkbox" id="nav-toggle" />

<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-left">
            <div class="brand-logo">
                <img src="<?= BASE_URL ?>/Assets/img/logo.png" alt="Logo Empresa" />
            </div>
            <div class="brand-info">
                <span class="brand-title">Empresa X</span>
                <span class="brand-sub">Panel</span>
            </div>
        </div>

        <label for="nav-toggle" class="sidebar-collapse" title="Colapsar/expandir" aria-label="Colapsar/expandir">
            <i class="fa-solid fa-bars"></i>
        </label>
    </div>

    <div class="menu-sidebar">
        <div class="menu-sidebar-title">General</div>

        <a href="<?= BASE_URL ?>/Home" class="sidebar-menu-item <?= strpos($currentRoute, '/Home') !== false ? 'active' : '' ?>">
            <i class="fa-solid fa-house"></i>
            <span class="sidebar-text">Dashboard</span>
        </a>
        <a href="<?= BASE_URL ?>/Home/Proyectos" class="sidebar-menu-item">
            <i class="fa-solid fa-list"></i>
            <span class="sidebar-text">Proyectos</span>
        </a>

        <?php if ($_SESSION["rol_id"] == 1): ?>
            <a href="#" class="sidebar-menu-item <?= strpos($currentRoute, '/Reportes') !== false ? 'active' : '' ?>">
                <i class="fa-solid fa-chart-simple"></i>
                <span class="sidebar-text">Reportes</span>
            </a>
        <?php endif; ?>
        <div class="sidebar-separator"></div>
        <?php if ($_SESSION["rol_id"] == 1): ?>
            <div class="menu-sidebar-title">Configuración</div>
            <a href="<?= BASE_URL ?>/Usuarios" class="sidebar-menu-item <?= strpos($currentRoute, '/Usuarios') !== false ? 'active' : '' ?>">
                <i class="fa-solid fa-user"></i>
                <span class="sidebar-text">Usuarios</span>
            </a>
            <a href="<?= BASE_URL ?>/Clientes" class="sidebar-menu-item <?= strpos($currentRoute, '/Clientes') !== false ? 'active' : '' ?>">
                <i class="fa-solid fa-users"></i>
                <span class="sidebar-text">Clientes</span>
            </a>
        <?php endif; ?>
        
    </div>

    <div class="sidebar-footer">
        <a onclick="logout()" class="sidebar-menu-item">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span class="sidebar-text">Salir</span>
        </a>
    </div>
</aside>