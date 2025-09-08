<?php
header('Content-Type: application/json; charset=utf-8');

// Simulación de tareas
$tareas = [
    ["id" => 1, "nombre" => "Preparar informe mensual", "completada" => false],
    ["id" => 2, "nombre" => "Actualizar base de datos", "completada" => false],
    ["id" => 3, "nombre" => "Revisar tickets de soporte", "completada" => false],
    ["id" => 4, "nombre" => "Capacitación de personal", "completada" => false],
    ["id" => 5, "nombre" => "Optimizar servidores", "completada" => false]
];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($tareas);
    exit;
}
