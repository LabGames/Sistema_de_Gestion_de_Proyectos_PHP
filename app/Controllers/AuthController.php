<?php
require_once __DIR__ . "/../Models/User.php";

class AuthController
{
    private $user;

    public function __construct($pdo)
    {
        $this->user = new User($pdo);
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $user = $this->user->findByEmail($email);

            if ($user && password_verify($password, $user["password"])) {
                if (session_status() === PHP_SESSION_NONE) session_start();
                session_regenerate_id(true);
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["name"]    = $user["name"];
                $_SESSION["email"] = $user["email"];
                header("Location: " . BASE_URL . "/Home");
                exit;
            } else {
                $error = "Correo o contraseña incorrectos.";
            }
        }
        include __DIR__ . "/../Views/login.php";
    }


    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = trim($_POST["name"]);
            $email = trim($_POST["email"]);
            $password = $_POST["password"];
            $password_confirm = $_POST["password_confirm"];

            if (strlen($password) < 8) {
                $error = "La contraseña debe tener al menos 8 caracteres.";
            } elseif ($password !== $password_confirm) {
                $error = "Las contraseñas no coinciden.";
            } elseif ($this->user->findByEmail($email)) {
                $error = "El correo ya está registrado.";
            } else {
                $this->user->create($name, $email, $password);
                header("Location: " . BASE_URL . "/Login");
                exit;
            }
        }

        include __DIR__ . "/../Views/register.php";
    }

    public function home()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $nombre = $_SESSION['name'] ?? 'Invitado';
        include __DIR__ . "/../Views/home/index.php";
    }


    public function main()
    {
        include __DIR__ . "/../Views/main.php";
    }

    public function dash()
    {
        include __DIR__ . "/../Views/home/index.php";
    }

    public function logout()
    {
        session_destroy();
        header("Location: " . BASE_URL . "/Login");
    }
}
