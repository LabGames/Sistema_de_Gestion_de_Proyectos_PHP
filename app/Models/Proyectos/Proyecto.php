<?php
class Proyecto
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($data)
    {
        $sql = "INSERT INTO proyectos 
                (nombre, cliente_id, tipo_id, estado_id, fecha_inicio, fecha_fin, tiempo_estimado_horas, jefe_proyecto_id, pronostico, ingresos, archivo, tiempo_real_horas)
                VALUES (:nombre, :cliente_id, :tipo_id, :estado_id, :fecha_inicio, :fecha_fin, :tiempo_estimado_horas, :jefe_proyecto_id, :pronostico, :ingresos, :archivo, :tiempo_real_horas)";

        $stmt = $this->pdo->prepare($sql);

        $data['tiempo_real_horas'] = 0;

        return $stmt->execute([
            ':nombre' => $data['nombre'],
            ':cliente_id' => $data['cliente_id'],
            ':tipo_id' => $data['tipo_id'],
            ':estado_id' => $data['estado_id'],
            ':fecha_inicio' => $data['fecha_inicio'],
            ':fecha_fin' => $data['fecha_fin'],
            ':tiempo_estimado_horas' => $data['tiempo_estimado_horas'],
            ':jefe_proyecto_id' => $data['jefe_proyecto_id'],
            ':pronostico' => $data['pronostico'],
            ':ingresos' => $data['ingresos'],
            ':archivo' => $data['archivo'] ?? null,
            ':tiempo_real_horas' => $data['tiempo_real_horas']
        ]);
    }

    public function actualizarTiempoReal($proyecto_id)
    {
        $stmt = $this->pdo->prepare("SELECT fecha_inicio FROM proyectos WHERE id = :id");
        $stmt->execute([':id' => $proyecto_id]);
        $proyecto = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$proyecto) {
            return false;
        }

        $fecha_inicio = new DateTime($proyecto['fecha_inicio']);
        $fecha_actual = new DateTime();

        $intervalo = $fecha_inicio->diff($fecha_actual);
        $tiempo_real_horas = $intervalo->days * 24 + $intervalo->h + $intervalo->i / 60;

        $update = $this->pdo->prepare("UPDATE proyectos SET tiempo_real_horas = :tiempo_real_horas WHERE id = :id");
        return $update->execute([
            ':tiempo_real_horas' => $tiempo_real_horas,
            ':id' => $proyecto_id
        ]);
    }

    public function actualizarTodosLosProyectos()
    {
        $stmt = $this->pdo->query("SELECT id FROM proyectos");
        $proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($proyectos as $p) {
            $this->actualizarTiempoReal($p['id']);
        }
    }
}
