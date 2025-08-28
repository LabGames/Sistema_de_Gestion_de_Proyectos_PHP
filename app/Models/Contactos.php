<?php
class Contactos
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM contactos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByClienteId($cliente_id)
    {
        $sql = "SELECT * FROM contactos WHERE cliente_id = :cliente_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':cliente_id' => $cliente_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM contactos WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($cliente_id, $nombre, $correo, $telefono)
    {
        $sql = "INSERT INTO contactos (cliente_id, nombre, correo, telefono) VALUES (:cliente_id, :nombre, :correo, :telefono)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':cliente_id'   => $cliente_id,
            ':nombre'      => $nombre,
            ':correo'    => $correo,
            ':telefono' => $telefono
        ]);

        return $this->pdo->lastInsertId();
    }

    public function update($id, $nombre, $correo, $telefono)
    {

        $sql = "UPDATE contactos 
                   SET nombre = :nombre, correo = :correo, telefono = :telefono 
                 WHERE id = :id";
        $params = [
            ':id'       => $id,
            ':nombre'      => $nombre,
            ':correo'    => $correo,
            ':telefono' => $telefono
        ];


        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM contactos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
