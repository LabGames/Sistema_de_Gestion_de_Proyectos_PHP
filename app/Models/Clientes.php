<?php
class Clientes
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $sql = "SELECT c.*, e.nombre AS estado_nombre
            FROM clientes c
            INNER JOIN estados_cliente e ON c.estado_id = e.id";

        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByUserId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE user_id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nombre_cliente, $empresa, $rubro, $contacto, $estado, $user_id)
    {
        $sql = "INSERT INTO clientes (nombre_cliente, empresa, rubro, contacto_principal, estado_id, user_id) 
            VALUES (:nombre_cliente, :empresa, :rubro, :contacto_principal, :estado_id, :user_id)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':nombre_cliente'      => $nombre_cliente,
            ':empresa'             => $empresa,
            ':rubro'               => $rubro,
            ':contacto_principal'  => $contacto,
            ':estado_id'           => $estado,
            ':user_id'             => $user_id
        ]);

        return $this->pdo->lastInsertId();
    }


    public function update($id, $nombre, $empresa, $rubro, $contacto, $estado, $user_id)
    {

        $sql = "UPDATE clientes 
                   SET nombre_cliente = :nombre_cliente, empresa = :empresa, rubro = :rubro, contacto_principal = :contacto_principal, estado_id = :estado_id, user_id = :user_id
                 WHERE id = :id";
        $params = [
            ':id'       => $id,
            ':nombre_cliente'   => $nombre,
            ':empresa'   => $empresa,
            ':rubro'      => $rubro,
            ':contacto_principal'    => $contacto,
            ':estado_id' => $estado,
            ':user_id'   => $user_id
        ];

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM clientes WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function estadoCliente($userId)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM clientes WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchColumn() > 0;
    }

    public function verificarContactoPrincipal($id){
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE contacto_principal = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function asignarContactoPrincipal($idContacto,$idCliente)
    {

        $sql = "UPDATE clientes 
                   SET contacto_principal = :contacto_principal
                 WHERE id = :id";
        $params = [
            ':id'       => $idCliente,
            ':contacto_principal'    => $idContacto,
        ];

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function updateDatos($id, $nombre, $empresa, $rubro)
    {

        $sql = "UPDATE clientes 
                   SET nombre_cliente = :nombre_cliente, empresa = :empresa, rubro = :rubro
                 WHERE id = :id";
        $params = [
            ':id'       => $id,
            ':nombre_cliente'   => $nombre,
            ':empresa'   => $empresa,
            ':rubro'      => $rubro,
        ];

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
}
