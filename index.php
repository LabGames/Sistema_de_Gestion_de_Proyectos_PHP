<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa X - Gestor de Proyectos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <img src="images/logo.png.webp" alt="Empresa X">
        <div class="btns">
            <a href="php/registers/register_main.php" class="btn-register">REGISTRARSE</a>
            <a href="php/registers/register_main.php" class="btn-login">INICIAR SESIÓN</a>
        </div>
    </header>

    <section class="hero">
        <h1>GESTOR DE<br>PROYECTOS EMPRESARIALES</h1>
        <p>En esta página podrás registrar tus proyectos, recursos para poder evaluarlos con éxito, verificar estadísticas y optimizar los tiempos para que se lleven adecuadamente por los colaboradores.</p>
        <button href="php/registers/register_main.php" >REGISTRARSE AHORA</button>
    </section>

    <section class="features">
        <h2>En esta página podrás:</h2>
        <div class="cards">
            <div class="card">
                <img src="images/card1.jpg" alt="Seguimiento de proyectos">
                <p>Hacer seguimiento de proyectos, clientes y sus contactos.</p>
            </div>
            <div class="card">
                <img src="images/card2.jpg" alt="Registro de ventas">
                <p>Realizar un registro de ventas o cierre de una empresa.</p>
            </div>
            <div class="card">
                <img src="images/card3.jpg" alt="Asignar tareas">
                <p>Asignar tareas a colaboradores y generación de estadísticas.</p>
            </div>
        </div>
        <button href="php/registers/register_main.php" class="btn-main">Registrar Proyecto</button>
    </section>

    <footer>
        <img src="images/logo.png.webp" alt="Empresa X">
        <nav>
            <a href="#">Inicio</a>
            <a href="#">Proyectos</a>
            <a href="#">Contacto</a>
            <a href="#">Ayuda</a>
        </nav>
    </footer>
</body>
</html>
