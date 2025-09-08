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

        <a href="<?= BASE_URL ?>/Home" class="sidebar-menu-item active">
            <i class="fa-solid fa-house"></i>
            <span class="sidebar-text">Dashboard</span>
        </a>

        <a href="<?= BASE_URL ?>/Home/Proyectos" class="sidebar-menu-item">
            <i class="fa-solid fa-list"></i>
            <span class="sidebar-text">Proyectos</span>
        </a>

        <a href="#" class="sidebar-menu-item">
            <i class="fa-solid fa-chart-simple"></i>
            <span class="sidebar-text">Reportes</span>
        </a>

        <div class="sidebar-separator"></div>

        <div class="menu-sidebar-title">Configuracion</div>
        <a href="<?= BASE_URL ?>/Usuarios" class="sidebar-menu-item">
            <i class="fa-solid fa-user"></i>
            <span class="sidebar-text">Usuarios</span>
        </a>
        <a href="<?= BASE_URL ?>/Clientes" class="sidebar-menu-item">
        <i class="fa-solid fa-users"></i>
            <span class="sidebar-text">Clientes</span>
        </a>
        <a href="#" class="sidebar-menu-item">
            <i class="fa-solid fa-gear"></i>
            <span class="sidebar-text">Ajustes</span>
        </a>
    </div>

    <div class="sidebar-footer">
        <a onclick="logout()" class="sidebar-menu-item">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span class="sidebar-text">Salir</span>
        </a>
    </div>
</aside>