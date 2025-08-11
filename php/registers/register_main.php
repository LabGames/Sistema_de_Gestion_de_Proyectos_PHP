<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Empresa X</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="registro-page">

<!-- HEADER -->
<header>
    <h1>EMPRESA X</h1>
    <a href="../../index.php" class="btn-register">REGRESAR</a>
</header>

<!-- FORMULARIO -->
<div class="form-container">
    <form action="procesar_registro.php" method="POST">
        <input type="text" name="nombre" placeholder="Nombre/ID" required>
        <input type="text" name="numero" placeholder="Número" required>
        <input type="email" name="correo" placeholder="Correo" required>
        <input type="text" name="empresa" placeholder="Empresa" required>

        <label class="checkbox">
            <input type="checkbox" name="recordar"> Recuerde mis datos
        </label>

        <div class="form-buttons">
            <button type="submit" name="accion" value="login">Log in</button>
            <button type="submit" name="accion" value="register">Register</button>
        </div>
    </form>
    <img src="images/logo.png.webp" alt="Logo Empresa X" class="form-logo">
</div>

</body>
</html>
