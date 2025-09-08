<?php
class Tipos
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT id, nombre FROM tipos_proyecto");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
