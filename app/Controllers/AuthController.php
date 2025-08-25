<?php
require_once __DIR__ . "/../Models/User.php";

class AuthController
{
    private $user;

    public function __construct($pdo)
    {
        $this->user = new User($pdo);
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

    public function new_proyect()
    {
        include __DIR__ . "/../Views/new_proyect.php";
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
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST["email"] ?? '';
            $password = $_POST["password"] ?? '';

            $user = $this->user->findByEmail($email);

            if ($user && password_verify($password, $user["password"])) {
                if (session_status() === PHP_SESSION_NONE) session_start();
                session_regenerate_id(true);

                $_SESSION["user_id"] = $user["id"];
                $_SESSION["name"]    = $user["nombre"];
                $_SESSION["email"]   = $user["email"];

                header('Content-Type: application/json');
                echo json_encode([
                    "success" => true,
                    "redirect" => BASE_URL . "/Home"
                ]);
                exit;
            } else {
                $error = "Correo o contraseña incorrectos.";
                header('Content-Type: application/json');
                echo json_encode(["success" => false, "message" => $error]);
                exit;
            }
        }
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = trim($_POST["name"]);
            $email = trim($_POST["email"]);
            $password = $_POST["password"];
            $rol = 1;
            $password_confirm = $_POST["password_confirm"];

            if (strlen($password) < 8) {
                header('Content-Type: application/json');
                echo json_encode([
                    "success" => false,
                    "error" => "La contraseña debe tener al menos 8 caracteres."
                ]);
            } elseif ($password !== $password_confirm) {
                header('Content-Type: application/json');
                echo json_encode([
                    "success" => false,
                    "error" => "Las contraseñas no coinciden."
                ]);
            } elseif ($this->user->findByEmail($email)) {
                header('Content-Type: application/json');
                echo json_encode([
                    "success" => false,
                    "error" => "El correo ya está registrado."
                ]);
            } else {
                $this->user->create($name, $email, $password, $rol);
                header('Content-Type: application/json');
                echo json_encode([
                    "success" => true,
                    "redirect" => BASE_URL . "/Login"
                ]);
                exit;
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header('Content-Type: application/json');
        echo json_encode([
            "success" => false,
            "redirect" => BASE_URL . "/Login"
        ]);
    }
}
