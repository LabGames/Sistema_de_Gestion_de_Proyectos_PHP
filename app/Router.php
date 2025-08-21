<?php
class Router
{
    private $pdo;
    private $publicRoutes = ['Login', 'Registro', ''];
    private $privateRoutes = ['Home', 'Logout','/Dash'];

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        session_start();
    }

    private function isAuthenticated(): bool
    {
        return !empty($_SESSION['user_id']);
    }

    public function dispatch($url)
    {
        require_once __DIR__ . "/Controllers/AuthController.php";
        require_once __DIR__ . "/Controllers/HomeController.php";
        $controller = new AuthController($this->pdo);
        $HomeController = new HomeController($this->pdo);

        if (in_array($url, $this->privateRoutes) && !$this->isAuthenticated()) {
            header("Location: " . BASE_URL . "/Login");
            exit;
        }

        switch ($url) {
            case '':
                $controller->welcome();
                break;
            case 'Login':
                $controller->index();
                break;
            case 'Login/Ingresar':
                $controller->login();
                break;
            case 'Registro':
                $controller->index_registro();
                break;
            case 'Registro/Crear':
                $controller->register();
                break;
            case 'Home':
                $HomeController->index();
                break;
            case 'Dash':
                $controller->dash();
                break;
            case 'Logout':
                $controller->logout();
                break;
            default:
                echo "404 - Página no encontrada";
        }
    }
}
