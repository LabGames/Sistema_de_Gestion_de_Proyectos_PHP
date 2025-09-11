<?php
require_once __DIR__ . "/../Models/tareas/Tarea.php";

class GestorTareasController

{ private $tareas;

    public function __construct($pdo)
    {
        $this->tareas = new Tarea($pdo);
    }

    public function index()
    {
        $view = __DIR__ . "/../Views/gestor_tareas/colaborador_gestor.php";
        include __DIR__ . "/../Views/home/index.php";
    }

      public function listar()
    {
        $tareas = $this->tareas->getAll();
        echo json_encode($tareas);
    }

    // Nuevo: guardar tarea
    public function guardar()
    {
        global $pdo;
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(["error" => "Datos inválidos"]);
            return;
        }

        $tarea = new Tarea($pdo);
        $ok = $tarea->crear(
            $data["titulo"],
            $data["descripcion"],
            $data["fecha_limite"],
            $data["prioridad"]
        );

        echo json_encode(["success" => $ok]);
    }
}