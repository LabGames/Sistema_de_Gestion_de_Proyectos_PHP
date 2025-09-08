<?php
require_once __DIR__ . "/../Models/User.php";
require_once __DIR__ . "/../Models/Clientes.php";

class AuthController
{
    private $user;
    private $clientes;

    public function __construct($pdo)
    {
        $this->user = new User($pdo);
        $this->clientes = new Clientes($pdo);
    }

    public function index()
    {
        include __DIR__ . "/../Views/login.php";
    }

    public function dash()
    {
        $view = __DIR__ . "/../Views/contenido1.php";
        include __DIR__ . "/../Views/home/index.php";
    }

    public function index_registro()
    {
        include __DIR__ . "/../Views/register.php";
    }

    public function welcome()
    {
        include __DIR__ . "/../Views/main.php";
    }

    public function admin_collab()
    {
        include __DIR__ . "/../Views/admin_collab.php";
    }

    public function admin_manager()
    {
        include __DIR__ . "/../Views/admin_manager.php";
    }

    public function login()
    {
        $email    = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        $user = $this->user->findByEmail($email);
        $cliente = $this->clientes->findByUserId($user["id"]);

        if ($user["estado"] == 0) {
            echo json_encode([
                "success" => false,
                "message" => "Usuario Inhabilitado",
            ]);
            return;
        }

        if ($user && password_verify($password, $user["password"])) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            session_regenerate_id(true);

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["name"]    = $user["nombre"];
            $_SESSION["email"]   = $user["email"];
            $_SESSION["rol_id"]   = $user["rol_id"];
            $_SESSION["estado_cliente"] = $this->clientes->estadoCliente($user["id"]);
            if ($cliente) {
                $_SESSION["cliente_id"] = $cliente["id"];
            }
            
            echo json_encode([
                "success" => true,
                "redirect" => BASE_URL . "/Home"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Credenciales incorrectas",
            ]);
        }
    }

    public function logout()
    {
        session_destroy();
        echo json_encode([
            "success" => false,
            "redirect" => BASE_URL . "/Login"
        ]);
    }
}
