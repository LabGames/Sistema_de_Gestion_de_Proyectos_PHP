<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <from class="formulario">
    <nav>
      <img src="logo.png" alt="Logo" class="logo">
      <ul class="menu">
        <li class= "li-formulario"><a href="#">Regresar</a></li>
      </ul>
    </nav>
    <h2 class= "h2-registro">Registrar proyecto</h2>
    <form method="post">
      
      <div class="nombre">
        <label for="nombre">Nombre de proyecto:</label>
        <input type="text" id="nombre" name="nombre" required>
      </div>
      <div class="apellido">
        <label for="apellido">tipo de proyecto:</label>
        <input type="text" id="apellido" name="apellido" required>
      </div>
      <div class="email">
        <label for="email">Cliente asociado:</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="password">
        <label for="password">Estado de proyecto:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="fecha">
        <label for="fecha">Fecha de inicio:</label>
        <input type="date" id="fecha" name="fecha" required>
      </div>
      <div class="fecha">
        <label for="fecha">Fecha limite:</label>
        <input type="date" id="fecha" name="fecha" required>
      </div>
      <div class="Tiempo">
        <label for="Tiempo">Tiempo estimado:</label>
        <input type="text" id="Tiempo" name="Tiempo" required>
      </div>
      <div class="Time">
        <label for="Time">Tiempo real:</label>
        <input type="text" id="Time" name="Time" required>
      </div>
    </section>
    <button> Registrar </button>
  </from>
</body>
</html>