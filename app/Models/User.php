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

    public function create($name, $email, $password, $rol)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nombre, email, password, rol_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $email, $hash, $rol]);
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM usuarios");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create1($name, $rol, $email, $password)
    {
        $sql = "INSERT INTO usuarios (nombre, rol, email, password) VALUES (:nombre, :rol, :email, :password)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nombre'   => $name,
            ':rol'      => $rol,
            ':email'    => $email,
            ':password' => $password
        ]);
    }
}
