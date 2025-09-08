<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents("php://input"), true);
$id = $input['id'] ?? null;

if ($id) {
    // Aquí actualizarías la tarea en la base de datos
    echo json_encode(["success" => true, "message" => "Tarea $id completada"]);
} else {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "ID de tarea faltante"]);
}
exit;
