<?php
require_once __DIR__ . "/../Models/User.php";

class UserController
{

    private $user;

    public function __construct($pdo)
    {
        $this->user = new User($pdo);
    }

    public function index()
    {
        $view = __DIR__ . "/../Views/usuarios/index.php";
        include __DIR__ . "/../Views/home/index.php";
    }

    public function listar()
    {
        $usuarios = $this->user->getAll();
        header('Content-Type: application/json');
        echo json_encode($usuarios);
    }

    public function registrar()
    {
        $name     = $_POST['name'] ?? null;
        $rol      = $_POST['rol'] ?? null;
        $email    = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        if (!$name || !$rol || !$email || !$password) {
            echo json_encode([
                "success" => false,
                "message" => "Todos los campos son obligatorios"
            ]);
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $resultado = $this->user->create1($name, $rol, $email, $hashedPassword);

        if ($resultado) {
            echo json_encode([
                "success" => true,
                "message" => "Usuario registrado correctamente"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Error al registrar usuario"
            ]);
        }
    }
}
