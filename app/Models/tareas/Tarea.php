<?php
class Tarea {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $sql = "SELECT t.*, e.nombre AS estado_nombre
            FROM tareas t
            INNER JOIN estados_tareas e ON t.estado_id = e.id";

        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($titulo, $descripcion, $fecha_limite, $prioridad) {
        $sql = "INSERT INTO tareas (titulo, descripcion, fecha_limite, prioridad, estado_id, created_at, updated_at)
                VALUES (:titulo, :descripcion, :fecha_limite, :prioridad, 1, NOW(), NOW())";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":titulo" => $titulo,
            ":descripcion" => $descripcion,
            ":fecha_limite" => $fecha_limite,
            ":prioridad" => $prioridad
        ]);
    }
}
