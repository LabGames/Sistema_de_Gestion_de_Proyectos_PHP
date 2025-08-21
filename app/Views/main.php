<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa X</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/main.css">
</head>

<body>
    <!-- Navbar -->
    <header class="navbar" role="banner">
        <div class="nav-inner">
            <a href="<?= BASE_URL ?>/" class="nav-brand" aria-label="Inicio">
                <img src="<?= BASE_URL ?>/Assets/img/logo.png" alt="Logo Empresa" class="nav-brand-logo" />
                <span class="nav-brand-text">Empresa X</span>
            </a>

            <nav class="nav-actions" aria-label="Acciones principales">
                <a class="btn-nav btn-nav-dark" href="<?= BASE_URL ?>/Registro">Registrarse</a>
                <a class="btn-nav btn-nav-light" href="<?= BASE_URL ?>/Login">Iniciar Sesion</a>
            </nav>
        </div>
    </header>
    <!-- Banner -->
    <section class="banner-main">
        <div class="banner-slides">
            <div class="banner-slide-bg">
            </div>
        </div>
        <div class="overlay-banner2"></div>
        <div class="overlay-banner"></div>
        <div class="banner-content">
            <h1>Gestor de <br /> proyectos <br /> empresariales</h1>
            <p>
                En esta página podrá registrar sus proyectos en curso para poder
                evaluar sus avances, verificar el estado y gestionar las tareas que se
                les fueron asignadas por los colaboradores.
            </p>
            <button class="btn-banner-register">REGISTRARSE AHORA</button>
        </div>
    </section>
    <!-- Projects -->
    <section class="projects-section" aria-labelledby="projects-title">
        <div class="projects-glow"></div>
        <!-- Seccion 1 -->
        <h2 id="projects-title" class="projects-heading">
            En esta pagina podras:
        </h2>

        <div class="proj-grid">
            <div class="proj-card">
                <img class="proj-img" src="<?= BASE_URL ?>/Assets/img/projects/project1.jpeg" alt="" />
                <div class="proj-overlay"></div>
                <h3 class="proj-caption">Hacer seguimiento de proyectos, clientes y sus contactos</h3>
            </div>
            <div class="proj-card">
                <img class="proj-img" src="<?= BASE_URL ?>/Assets/img/projects/project2.jpeg" alt="" />
                <div class="proj-overlay"></div>
                <h3 class="proj-caption">Realizar un registro de ventas o cierre de una empresa</h3>
            </div>
            <div class="proj-card">
                <img class="proj-img" src="<?= BASE_URL ?>/Assets/img/projects/project3.jpeg" alt="" />
                <div class="proj-overlay"></div>
                <h3 class="proj-caption">Asignar tareas a colaboradores y generación de estadísticas</h3>
            </div>
        </div>

        <!-- Seccion 2 -->
        <div class="project-section-2">
            <h2 id="projects-title" class="projects-heading">
                Mas de 1000 proyectos registrados al dia:
            </h2>
            <div class="proj-grid">
                <div class="proj-card">
                    <img class="proj-img" src="<?= BASE_URL ?>/Assets/img/projects/project1.jpeg" alt="" />
                    <div class="proj-overlay"></div>
                    <h3 class="proj-caption">Nueva Cadena de Comida en Sydney</h3>
                </div>
                <div class="proj-card">
                    <img class="proj-img" src="<?= BASE_URL ?>/Assets/img/projects/project2.jpeg" alt="" />
                    <div class="proj-overlay"></div>
                    <h3 class="proj-caption">Campaña de concientacion sobre el medio ambiente.</h3>
                </div>
                <div class="proj-card">
                    <img class="proj-img" src="<?= BASE_URL ?>/Assets/img/projects/project3.jpeg" alt="" />
                    <div class="proj-overlay"></div>
                    <h3 class="proj-caption">Nueva saga de videojuegos para Super Smash Bros.</h3>
                </div>
            </div>
            <div class="projects-cta">
                <h3>¡No te quedes atras! Registra tu proyecto y forma parte de nuestra gran comunidad:</h3>
                <button
                    type="button"
                    class="btn-proj"
                    aria-label="Registrar nuevo proyecto">
                    Registrar Proyecto
                </button>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="site-footer" role="contentinfo">
        <div class="footer-inner">
            <div class="footer-grid">
                <div class="footer-col footer-brand">
                    <a href="<?= BASE_URL ?>/" class="brand-footer-logo" aria-label="Inicio">
                        <img src="<?= BASE_URL ?>/Assets/img/logo.png" class="footer-logo" alt="Empresa X" />
                        <div class="footer-logo-fallback">Empresa X</div>
                    </a>
                    <p class="footer-desc">
                        Plataforma para registrar, dar seguimiento y analizar el avance de
                        tus proyectos empresariales.
                    </p>

                    <div class="footer-social" aria-label="Redes sociales">
                        <a href="#" aria-label="Facebook" class="social-btn">
                            <svg
                                viewBox="0 0 24 24"
                                width="18"
                                height="18"
                                aria-hidden="true">
                                <path
                                    fill="currentColor"
                                    d="M22 12.06C22 6.51 17.52 2 12 2S2 6.51 2 12.06c0 5.01 3.66 9.17 8.44 9.94v-7.03H7.9v-2.91h2.54V9.41c0-2.5 1.49-3.88 3.77-3.88 1.09 0 2.24.2 2.24.2v2.47h-1.26c-1.24 0-1.62.77-1.62 1.56v1.87h2.76l-.44 2.91h-2.32V22c4.78-.77 8.44-4.93 8.44-9.94Z" />
                            </svg>
                        </a>
                        <a href="#" aria-label="Twitter" class="social-btn">
                            <svg
                                viewBox="0 0 24 24"
                                width="18"
                                height="18"
                                aria-hidden="true">
                                <path
                                    fill="currentColor"
                                    d="M22 5.94c-.73.33-1.5.55-2.31.65a4.02 4.02 0 0 0 1.76-2.21 8.02 8.02 0 0 1-2.55.98 4 4 0 0 0-6.91 3.65A11.37 11.37 0 0 1 3.16 4.9a4 4 0 0 0 1.24 5.34 3.96 3.96 0 0 1-1.81-.5v.05a4.01 4.01 0 0 0 3.21 3.92 4.05 4.05 0 0 1-1.8.07 4.01 4.01 0 0 0 3.74 2.78A8.04 8.04 0 0 1 2 18.57a11.35 11.35 0 0 0 6.15 1.8c7.38 0 11.42-6.12 11.42-11.43 0-.17 0-.35-.01-.52.79-.57 1.47-1.28 2.02-2.08Z" />
                            </svg>
                        </a>
                        <a href="#" aria-label="LinkedIn" class="social-btn">
                            <svg
                                viewBox="0 0 24 24"
                                width="18"
                                height="18"
                                aria-hidden="true">
                                <path
                                    fill="currentColor"
                                    d="M4.98 3.5a2.5 2.5 0 1 1 0 5.001 2.5 2.5 0 0 1 0-5Zm.02 6.5H2V22h3V10ZM14.5 10c-2.02 0-3.02 1.1-3.54 1.87V10h-3v12h3v-6.7c0-1.36.67-2.3 2.03-2.3 1.2 0 1.97.84 1.97 2.3V22h3v-7.47C17.96 11.2 16.58 10 14.5 10Z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <nav class="footer-col" aria-label="Enlaces">
                    <h4>Enlaces</h4>
                    <ul class="footer-list">
                        <li>
                            <a href="#" class="footer-link">
                                Inicio
                            </a>
                        </li>
                        <li>
                            <a href="#" class="footer-link">
                                Proyectos
                            </a>
                        </li>
                        <li>
                            <a href="#" class="footer-link">
                                Tareas
                            </a>
                        </li>
                        <li>
                            <a href="#" class="footer-link">
                                Reportes
                            </a>
                        </li>
                    </ul>
                </nav>

                <nav class="footer-col" aria-label="Recursos">
                    <h4>Recursos</h4>
                    <ul class="footer-list">
                        <li>
                            <a href="#" class="footer-link">
                                Documentación
                            </a>
                        </li>
                        <li>
                            <a href="#" class="footer-link">
                                Soporte
                            </a>
                        </li>
                        <li>
                            <a href="#" class="footer-link">
                                Guías
                            </a>
                        </li>
                        <li>
                            <a href="#" class="footer-link">
                                API
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="footer-col">
                    <h4>Boletín</h4>
                    <p class="footer-desc">
                        Recibe novedades y mejoras del sistema.
                    </p>
                    <form class="newsletter">
                        <input
                            type="email"
                            required
                            placeholder="Tu correo"
                            aria-label="Correo electrónico" />
                        <button type="submit" class="btn-news">
                            Suscribirse
                        </button>
                    </form>

                    <ul class="footer-contact">
                        <li>contacto@empresa.com</li>
                        <li>+51 999 999 999</li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <span>© 2025 Empresa X. Todos los derechos reservados.</span>
                <div class="footer-legal">
                    <a href="#" class="footer-link">
                        Términos
                    </a>
                    <a href="#" class="footer-link">
                        Privacidad
                    </a>
                    <a href="#" class="footer-link">
                        Estado
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>