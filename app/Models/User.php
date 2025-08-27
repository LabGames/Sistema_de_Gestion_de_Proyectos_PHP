<?php
class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT id, nombre, email, rol_id FROM usuarios WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($name, $rol, $email, $password, $estado)
    {
        $sql = "INSERT INTO usuarios (nombre, rol_id, email, password, estado) VALUES (:nombre, :rol, :email, :password, :estado)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nombre'   => $name,
            ':rol'      => $rol,
            ':email'    => $email,
            ':password' => $password,
            ':estado'   => $estado
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



    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM usuarios");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function activar($id)
    {
        $sql = "UPDATE usuarios SET estado = 1 WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function inhabilitar($id)
    {
        $sql = "UPDATE usuarios SET estado = 0 WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
