<?php
$valores = [14, 13, 7, 12, 8, 5, 3, 0];
$labels  = [
    "Proyectos Importantes",
    "Proyectos Semi Importantes",
    "Proyectos Secundarios",
    "Promedio de Tiempo entre proyectos",
    "Colaboradores con Excelente desempeño",
    "Colaboradores con Decente desempeño",
    "Colaboradores con Mal desempeño",
    "Otros"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style_report_module.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="../../js/radial_graph.js"></script>
    <title>Modulo de Reportes</title>
</head>
<body>
    <header>
        <nav>
            <ul class="nav_title">
                <li>
                    <a class="tittle">EMPRESA X</a>
                    <button class="tittle_button">Regresar</button>
                    <button class="tittle_button">Siguiente ➥</button>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <script>
            window.graficoValores = <?php echo json_encode($valores); ?>;
            window.graficoLabels  = <?php echo json_encode($labels);  ?>;
        </script>

        <canvas id="bake_circle_graph" width="700" height="500"></canvas>

        <nav class="report_info">
            <ul>
                <li>
                    <h3>Tipo de Proyectos:</h3>
                    <a>Importante (70%) /</a>
                    <a>Semi Importantes (20%) /</a>
                    <a>Secundarios (05%).</a>
                    <h3>Tiempo por Proyecto:</h3>
                    <a>Promedio General: 3 meses - 7 meses</a>
                    <h3>Productividad de los Colaboradores:</h3>
                    <a>Promedio General: Excelente (75%) / Decente (37%) / Malo (03%)</a>
                </li>
            </ul>
        </nav>
        <h1>GRAFICO DE BARRAS AQUI</h1>
        <nav class="report_stats">
            <ul>
                <li>
                    <h2>Proyectos por Realizar:</h2>
                    <a>22 aun a en espera.</a>
                    <h2>Proyectos en Cursos:</h2>
                    <a>5 aun en curso.</a>
                    <h2>Proyectos Terminados:</h2>
                    <a>7 proyectos concluidos.</a>
                    <h2>Proyectos Totales:</h2>
                    <a>34 proyectos en curso.</a>
                </li>
            </ul>
        </nav>
    </main>
    <footer>
        <p>Logo de la empresa aqui.</p>
    </footer>
</body>
</html>