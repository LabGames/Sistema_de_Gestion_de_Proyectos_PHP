<?php
header('Content-Type: application/json');

// Simulación de tareas asignadas al usuario
$misTareas = [
    ["id" => 1, "nombre" => "Preparar informe mensual", "completada" => false],
    ["id" => 2, "nombre" => "Actualizar base de datos", "completada" => false],
    ["id" => 3, "nombre" => "Revisar tickets de soporte", "completada" => false],
    ["id" => 4, "nombre" => "Capacitación de personal", "completada" => false],
    ["id" => 5, "nombre" => "Optimizar servidores", "completada" => false]
];


// Solo GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($misTareas);
    exit;
}
