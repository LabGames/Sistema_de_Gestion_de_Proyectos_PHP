<?php
class Rol {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT id, nombre FROM roles");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
