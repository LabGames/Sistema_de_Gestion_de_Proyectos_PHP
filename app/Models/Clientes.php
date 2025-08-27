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
        $stmt = $this->pdo->query("SELECT * FROM clientes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nombre_cliente, $empresa, $rubro, $contacto, $estado, $user_id)
    {
        $sql = "INSERT INTO clientes (nombre_cliente, empresa, rubro, contacto_principal, estado_id, user_id) VALUES (:nombre_cliente, :empresa, :rubro, :contacto_principal, :estado_id, :user_id)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nombre'   => $nombre_cliente,
            ':empresa'      => $empresa,
            ':rubro'    => $rubro,
            ':contacto_principal' => $contacto,
            ':estado_id'   => $estado,
            ':user_id'  => $user_id
        ]);
    }

    public function update($id, $name, $rol, $email, $password = null)
    {
        if ($password) {
            $sql = "UPDATE usuarios 
                   SET nombre = :nombre, rol_id = :rol, email = :email, password = :password 
                 WHERE id = :id";
            $params = [
                ':id'       => $id,
                ':nombre'   => $name,
                ':rol'      => $rol,
                ':email'    => $email,
                ':password' => $password
            ];
        } else {
            $sql = "UPDATE usuarios 
                   SET nombre = :nombre, rol_id = :rol, email = :email 
                 WHERE id = :id";
            $params = [
                ':id'     => $id,
                ':nombre' => $name,
                ':rol'    => $rol,
                ':email'  => $email
            ];
        }

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
