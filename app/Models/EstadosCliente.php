<?php
class EstadosCliente
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM estados_cliente");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
