<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Jefes de Proyecto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="bg-decoration">
        <div class="bg-shapes shape-1"></div>
        <div class="bg-shapes shape-2"></div>
        <div class="bg-shapes shape-3"></div>
    </div>

    <div class="container">
        <div class="header">
            <div class="header-left">
                <div class="breadcrumb">Panel de Jefes de Proyecto</div>
                <h1>Empresa X</h1>
                <div class="welcome-text">Bienvenido(a) Jefe Laura Rominez</div>
            </div>
            <div class="user-profile">
                <div class="profile-img">LR</div>
                <button class="logout-btn">Cerrar Sesión</button>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-card card-proyectos" onclick="navigateTo('proyectos')">
                <div class="card-image">
                    <div class="card-icon">📊</div>
                </div>
                <div class="card-overlay">
                    <div class="card-title">Ver Proyectos</div>
                </div>
            </div>

            <div class="dashboard-card card-tareas" onclick="navigateTo('tareas')">
                <div class="card-image">
                    <div class="card-icon">📋</div>
                </div>
                <div class="card-overlay">
                    <div class="card-title">Administrar Tareas</div>
                </div>
            </div>

            <div class="dashboard-card card-colaboradores" onclick="navigateTo('colaboradores')">
                <div class="card-image">
                    <div class="card-icon">👥</div>
                </div>
                <div class="card-overlay">
                    <div class="card-title">Administrar Colaboradores</div>
                </div>
            </div>

            <div class="dashboard-card card-reportes" onclick="navigateTo('reportes')">
                <div class="card-image">
                    <div class="card-icon">📈</div>
                </div>
                <div class="card-overlay">
                    <div class="card-title">Ver Reportes</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function navigateTo(section) {
            // Efecto de clic
            event.currentTarget.style.transform = 'scale(0.95)';
            setTimeout(() => {
                event.currentTarget.style.transform = 'translateY(-10px)';
            }, 100);

            // Simular navegación
            setTimeout(() => {
                alert(`Navegando a la sección: ${section.toUpperCase()}`);
                // Aquí puedes agregar la lógica real de navegación
                // window.location.href = section + '.html';
            }, 200);
        }

        // Animación de entrada
        window.addEventListener('load', () => {
            const cards = document.querySelectorAll('.dashboard-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(50px)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 200);
            });
        });

        // Logout functionality
        document.querySelector('.logout-btn').addEventListener('click', () => {
            if (confirm('¿Estás seguro de que deseas cerrar sesión?')) {
                alert('Cerrando sesión...');
                // Aquí puedes agregar la lógica real de logout
            }
        });
    </script>
</body>
</html>