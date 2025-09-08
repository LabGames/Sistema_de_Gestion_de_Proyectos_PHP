<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data["id"] ?? null;

    echo json_encode([
        "mensaje" => "Tarea asignada correctamente",
        "id" => $id
    ]);
    exit;
}

echo json_encode(["error" => "Método no permitido"]);
